<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudioBooking;

class StudioBookingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'matrics' => 'required',
            'club' => 'required',
            'reason' => 'required',
            'phone' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'time_slot' => 'required',
            'studio' => 'required|array|min:1|max:1', // Only 1 studio allowed
        ]);

        StudioBooking::create([
            'name' => $validated['name'],
            'matrics' => $validated['matrics'],
            'club' => $validated['club'],
            'reason' => $validated['reason'],
            'phone' => $validated['phone'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'time_slot' => $validated['time_slot'],
            'studio' => implode(',', $validated['studio']),
            'status' => 'pending', // Add default status
        ]);

        return back()->with('success', 'Booking submitted! Waiting for admin approval.');
    }

    // Admin: Show all bookings
    public function index()
    {
        $bookings = StudioBooking::all();
        return view('admin.bookings.index', compact('bookings'));
    }

    // Admin: Update booking status (accept/reject)
    public function updateStatus($id, $status)
    {
        $booking = StudioBooking::findOrFail($id);
        $booking->status = $status;
        $booking->save();

        return redirect()->route('admin.bookings')->with('success', 'Booking status updated.');
    }
}
