<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExperienceController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'company' => ['required', 'string'],
            'title' => ['required', 'string'],
            'start_date' => ['required', 'date'],
            'end_date' => ['sometimes', 'nullable', 'date'],
            'description' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $experience = Experience::create($validator->validated());

        return response()->json($experience->toArray());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Experience $experience)
    {
        $validator = Validator::make($request->all(), [
            'company' => ['required', 'string'],
            'title' => ['required', 'string'],
            'start_date' => ['required', 'date'],
            'end_date' => ['sometimes', 'nullable', 'date'],
            'description' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $experience->update($validator->validated());

        return response()->json($experience->toArray());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Experience $experience)
    {
        if (!$experience) {
            return response(404);
        }

        $experience->delete();

        return response(200);
    }
}
