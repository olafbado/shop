<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    // AdminDashboardController.php
public function index() {
    return view('admin.dashboard');
}



}
