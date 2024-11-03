<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Artwork;

class AdminDashboardController extends Controller
{   //@desc Admin Dashboard
    //@route GET /admin-dashboards
    public function index(): View
    {
        $artwork = new Artwork();
        $sender = new User();
        return view('admin-dashboard', compact ('artwork', 'sender'));
    }

    
}
