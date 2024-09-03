<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\DevlogSeries;

class DevlogSeriesController extends Controller
{
    public function show($param)
    {
        $series = DevlogSeries::where('id', $param)->orWhere('slug', $param)->first();
        $posts = \App\Models\DevlogPost::all();
        return view('devlog-post', [
            'posts' => $posts,
            'series' => $series,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string'],
            'slug' => ['sometimes', 'nullable', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        if (!$request->slug) {
            $request->merge(['slug' => Str::slug($request->title)]);
        }

        $series = DevlogSeries::create($validator->validated());

        return response()->json($series->toArray());
    }

    public function edit(DevlogSeries $series)
    {
        //
    }

    public function update(Request $request, DevlogSeries $series)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string'],
            'slug' => ['sometimes', 'nullable', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        if (!$request->slug) {
            $request->merge(['slug' => Str::slug($request->title)]);
        }

        $series->update($validator->validated());

        return response()->json($series->toArray());
    }

    public function destroy(DevlogSeries $series)
    {
        $series->delete();

        return response()->json($series->toArray());
    }
}
