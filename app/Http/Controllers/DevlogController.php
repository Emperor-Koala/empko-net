<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\DevlogPost;
use App\Models\DevlogSeries;

class DevlogController extends Controller
{
    public function index()
    {
        $posts = DevlogPost::all();
        $series = DevlogSeries::all();

        return view('devlog', [
            'posts' => $posts,
            'series' => $series,
        ]);
    }

    public function search(Request $request)
    {
        // filters: published_before, published_after, search, series
        $posts = DevlogPost::query()
            ->when($request->has('published_before'), function ($query) use ($request) {
                return $query->where('published_at', '<=', $request->published_before);
            })
            ->when($request->has('published_after'), function ($query) use ($request) {
                return $query->where('published_at', '>=', $request->published_after);
            })
            ->when($request->has('search'), function ($query) use ($request) {
                return $query->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('content', 'like', '%' . $request->search . '%');
            })
            ->when($request->has('series'), function ($query) use ($request) {
                return $query->where('series_id', $request->series);
            })
            ->get();
        $series = DevlogSeries::all();

        return view('devlog', [
            'posts' => $posts,
            'series' => $series,
        ]);
    }

    public function list()
    {
        //
    }

    public function create()
    {
        //
    }

}
