<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Enums\SoftwareType;
use App\Models\Software;

class SoftwareController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'type' => ['required', Rule::enum(SoftwareType::class)],
        ]);

        if ($validator->fails()) {
            return response(400)->json($validator->errors());
        }

        if (Software::query()->where('name', $request->name)->exists()) {
            return response(200);
        }

        $software = Software::create($validator->validated());

        return response()->json($software->toArray());
    }

    public function destroy(Software $software)
    {
        if (!$software) {
            return response(404);
        }

        $software->delete();

        return response(200);
    }
}
