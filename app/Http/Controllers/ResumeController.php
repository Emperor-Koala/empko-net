<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Language;
use App\Models\School;
use App\Models\Software;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ResumeController extends Controller
{
    public function index(): View
    {
        $user = User::first();
        $profileInfo = [
            'email' => $user->email,
            'phone' => $user->phone,
            'location' => $user->location,
            'title' => $user->title,
        ];
        $languages = [
            'familiar' => array_map(fn ($lang) => $lang['name'], Language::query()->where('level', 'familiar')->get()->toArray()),
            'proficient' => array_map(fn ($lang) => $lang['name'], Language::query()->where('level', 'proficient')->get()->toArray()),
        ];
        $software = [
            'platforms' => array_map(fn ($soft) => $soft['name'], Software::query()->where('type', 'platform')->get()->toArray()),
            'programs' => array_map(fn ($soft) => $soft['name'], Software::query()->where('type', 'program')->get()->toArray()),
        ];
        $experience = Experience::query()->orderByRaw('ISNULL(end_date), end_date DESC')->limit(3)->get();
        $education = School::query()->orderByRaw('ISNULL(end_date), end_date DESC')->limit(3)->get();
        return view('resume', compact('profileInfo', 'languages', 'software', 'experience', 'education'));
    }

    public function edit(Request $request): View
    {
        $user = User::first();
        $profileInfo = [
            'email' => $user->email,
            'phone' => $user->phone,
            'location' => $user->location,
            'title' => $user->title,
        ];
        $languages = [
            'familiar' => Language::query()->where('level', 'familiar')->get(),
            'proficient' => Language::query()->where('level', 'proficient')->get(),
        ];
        $software = [
            'platforms' => Software::query()->where('type', 'platform')->get(),
            'programs' => Software::query()->where('type', 'program')->get(),
        ];
        $experience = Experience::query()->orderByRaw('ISNULL(end_date), end_date DESC')->limit(3)->get();
        $education = School::query()->orderByRaw('ISNULL(end_date), end_date DESC')->limit(3)->get();
        return view('admin.resume', compact('profileInfo', 'languages', 'software', 'experience', 'education'));
    }
}
