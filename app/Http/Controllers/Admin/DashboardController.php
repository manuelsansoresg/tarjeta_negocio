<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BusinessProfile;

class DashboardController extends Controller
{
    public function index()
    {
        $profile = BusinessProfile::first();
        return view('admin.dashboard', compact('profile'));
    }
}