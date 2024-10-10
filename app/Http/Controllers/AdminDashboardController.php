<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{   //@desc Admin Dashboard
    //@route GET /admin-dashboards
    public function index(): View
    {
        return view('admin-dashboard');
    }
}
