<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BusinessProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BusinessProfileController extends Controller
{
    public function edit()
    {
        $profile = BusinessProfile::first() ?? new BusinessProfile();
        return view('admin.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'title' => ['nullable','string','max:255'],
            'description' => ['nullable','string'],
            'primary_color' => ['required','string','max:20'],
            'secondary_color' => ['required','string','max:20'],
            'accent_color' => ['required','string','max:20'],
            'background_color' => ['required','string','max:20'],
            'logo' => ['nullable','image','max:2048'],
        ]);

        $profile = BusinessProfile::first();
        if (!$profile) { $profile = new BusinessProfile(); }

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('public');
            $profile->logo_path = Storage::url($path);
        }

        $profile->title = $data['title'] ?? $profile->title;
        $profile->description = $data['description'] ?? $profile->description;
        $profile->primary_color = $data['primary_color'];
        $profile->secondary_color = $data['secondary_color'];
        $profile->accent_color = $data['accent_color'];
        $profile->background_color = $data['background_color'];
        $profile->save();

        return redirect()->route('admin.dashboard')->with('status','Perfil actualizado');
    }
}