<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientPanelController extends Controller
{
    // ClientPanelController.php
    public function index()
    {
        return view('client.panel');
    }
}
