<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\DevlogPost;

class DevlogPostController extends Controller
{
    public function show($param)
    {
        $post = DevlogPost::where('id', $param)->orWhere('slug', $param)->first();
        $series = \App\Models\DevlogSeries::all();
        return view('devlog-post', [
            'post' => $post,
            'series' => $series,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string'],
            'slug' => ['sometimes', 'nullable', 'string'],
            'content' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        if (!$request->slug) {
            $request->merge(['slug' => Str::slug($request->title)]);
        }

        $devlogPost = DevlogPost::create($validator->validated());

        return response()->json($devlogPost->toArray());
    }

    public function edit(DevlogPost $post)
    {
        //
    }

    public function update(Request $request, DevlogPost $post)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string'],
            'slug' => ['sometimes', 'nullable', 'string'],
            'content' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        if (!$request->slug) {
            $request->merge(['slug' => Str::slug($request->title)]);
        }

        $post->update($validator->validated());

        return response()->json($post->toArray());
    }

    public function destroy(DevlogPost $post)
    {
        $post->delete();

        return response()->json($post->toArray());
    }
}
