<?php

namespace App\Http\Controllers;

use App\Models\BusinessProfile;

class LandingController extends Controller
{
    public function index()
    {
        $profile = BusinessProfile::first();
        $links = $profile ? $profile->socialLinks()->where('enabled',true)->get() : collect();
        return view('landing', compact('profile','links'));
    }
}