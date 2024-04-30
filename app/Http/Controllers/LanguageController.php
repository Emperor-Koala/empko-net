<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Enums\LanguageLevel;
use App\Models\Language;
use Illuminate\Validation\Rule;

class LanguageController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'level' => ['required', Rule::enum(LanguageLevel::class)],
        ]);

        if ($validator->fails()) {
            return response(400)->json($validator->errors());
        }

        if (Language::query()->where('name', $request->name)->exists()) {
            return response(200);
        }

        $language = Language::create($validator->validated());

        return response()->json($language->toArray());
    }

    public function destroy(Language $language)
    {
        if (!$language) {
            return response(404);
        }

        $language->delete();

        return response(200);
    }
}
