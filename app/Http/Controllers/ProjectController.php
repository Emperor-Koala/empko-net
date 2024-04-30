<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    public function index()
    {
        return view("projects", ["projects" => Project::all()]);
    }

    public function show($param)
    {
        $project = Project::where('id', $param)->orWhere('slug', $param)->first();
        return view("project", ['project' => $project]);
    }

    public function list()
    {
        return view("admin.projects", ["projects" => Project::all()]);
    }

    public function create()
    {
        return view("admin.project-form", ['project' => ['id' => null, 'title' => '', 'description' => '', 'languages' => [], 'images' => []]]);
    }

    public function store(Request $request)
    {
        Log::debug(print_r($request->all(), true));

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:100',
            'description' => 'required|string',
            'languages' => 'array',
            'languages.*.name' => 'required|string|max:30',
            'languages.*.repo_link' => 'nullable|string|max:100',
            'languages.*.demo_link' => 'nullable|string|max:100',
            'file_ids' => 'array',
            'file_ids.*' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        $slug = Str::slug($validated['title']);
        if (Project::where('slug', $slug)->exists()) {
            $slug = $slug . '-' . time();
        }

        $project = Project::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'description' => $validated['description']
        ]);

        $languages = $validated['languages'];
        foreach ($languages as $language) {
            $project->languages()->create([
                'name' => $language['name'],
                'repo_link' => $language['repo_link'],
                'demo_link' => $language['demo_link']
            ]);
        }

        $fileIds = $validated['file_ids'];
        foreach ($fileIds as $fileId) {
            $project->images()->create([
                'file_id' => $fileId
            ]);
        }

        return redirect()->route('admin.projects', ['message' => 'Project created successfully']);
    }

    public function edit(Project $project)
    {
        return view("admin.project-form", ['project' => ['id' => $project->id, 'title' => $project->title, 'description' => $project->description, 'languages' => $project->languages, 'images' => $project->images]]);
    }

    public function update(Request $request, Project $project)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:100',
            'description' => 'required|string',
            'languages' => 'array',
            'languages.*.id' => 'nullable|integer',
            'languages.*.name' => 'required|string|max:30',
            'languages.*.repo_link' => 'nullable|string|max:100',
            'languages.*.demo_link' => 'nullable|string|max:100',
            'file_ids' => 'array',
            'file_ids.*' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        $slug = Str::slug($validated['title']);
        if (Project::where('slug', $slug)->where('id', '!=', $project->id)->exists()) {
            $slug = $slug . '-' . time();
        }

        $project->update([
            'title' => $validated['title'],
            'slug' => $slug,
            'description' => $validated['description']
        ]);

        $languages = $validated['languages'];
        $project->languages()->whereNotIn('id', array_column($languages, 'id'))->delete();
        foreach ($languages as $language) {
            if (isset($language['id'])) {
                $project->languages()->find($language['id'])->update([
                    'name' => $language['name'],
                    'repo_link' => $language['repo_link'],
                    'demo_link' => $language['demo_link']
                ]);
            } else {
                $project->languages()->create([
                    'name' => $language['name'],
                    'repo_link' => $language['repo_link'],
                    'demo_link' => $language['demo_link']
                ]);
            }
        }

        $fileIds = $validated['file_ids'];
        $project->images()->whereNotIn('file_id', $fileIds)->delete();
        foreach ($fileIds as $fileId) {
            $image = $project->images->find($fileId);
            if (!$image) {
                $project->images()->create([
                    'file_id' => $fileId
                ]);
            }
        }


        return redirect()->route('admin.projects', ['message' => 'Project updated successfully']);

    }

    public function destroy(Project $project)
    {
        if (!$project) {
            return response(404);
        }

        $project->delete();

        return response(200);
    }
}
