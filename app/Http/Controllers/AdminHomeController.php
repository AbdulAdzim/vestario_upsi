<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudioBooking;

class AdminHomeController extends Controller
{
    public function dashboard()
    {
        return view('admin.home', [
            'total' => StudioBooking::count(),
            'accepted' => StudioBooking::where('status', 'accepted')->count(),
            'pending' => StudioBooking::where('status', 'pending')->count(),
        ]);
    }
}