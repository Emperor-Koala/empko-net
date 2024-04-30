<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SchoolController extends Controller
{
   /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'school' => ['required', 'string'],
            'major' => ['required', 'string'],
            'gpa' => ['required', 'string'],
            'start_date' => ['required', 'date'],
            'end_date' => ['sometimes', 'nullable', 'date'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $school = School::create($validator->validated());

        return response()->json($school->toArray());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, School $school)
    {
        $validator = Validator::make($request->all(), [
            'school' => ['required', 'string'],
            'major' => ['required', 'string'],
            'gpa' => ['required', 'string'],
            'start_date' => ['required', 'date'],
            'end_date' => ['sometimes', 'nullable', 'date'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $school->update($validator->validated());

        return response()->json($school->toArray());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(School $school)
    {
        if (!$school) {
            return response(404);
        }

        $school->delete();

        return response(200);
    }
}
