<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudioBooking;
use App\Models\BusanaBooking;

class AdminHomeController extends Controller
{
    public function dashboard()
    {
        return view('admin.home', [
            // Studio Stats
            'studioTotal' => StudioBooking::count(),
            'studioAccepted' => StudioBooking::where('status', 'accepted')->count(),
            'studioPending' => StudioBooking::where('status', 'pending')->count(),

            // Busana Stats
            'busanaTotal' => BusanaBooking::count(),
            'busanaAccepted' => BusanaBooking::where('status', 'accepted')->count(),
            'busanaPending' => BusanaBooking::where('status', 'pending')->count(),
        ]);
    }
}