<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudioBooking;
use App\Models\BusanaBooking;

class BookingSearchController extends Controller
{
    public function index()
    {
        return view('bookings.search');
    }

    public function search(Request $request)
    {
        $request->validate([
            'matrics' => 'required',
            'type' => 'required|in:studio,busana',
        ]);

        $results = [];

        if ($request->type === 'studio') {
            $results = StudioBooking::where('matrics', $request->matrics)
                ->orderBy('created_at', 'desc')
                ->get();
        } elseif ($request->type === 'busana') {
            $results = BusanaBooking::where('matrics', $request->matrics)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('bookings.search', [
            'results' => $results,
            'matrics' => $request->matrics,
            'type' => $request->type,
        ]);
    }
}