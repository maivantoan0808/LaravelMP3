<?php

namespace App\Http\Controllers\Listener;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('backend.listener.settings');
    }
}
