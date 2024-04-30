<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)//: RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'phone' => ['required', 'string'],
            'location' => ['required', 'string'],
            'title' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response(400)->json($validator->errors());
        }

        $request->user()->fill($validator->validated());
        $request->user()->save();

        return response(200);
    }
}
