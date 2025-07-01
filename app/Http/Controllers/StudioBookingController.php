<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudioBooking;

class StudioBookingController extends Controller
{
    // User: Submit booking
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'matrics' => 'required',
            'club' => 'required',
            'reason' => 'required',
            'phone' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'time_slot' => 'required',
            'studio' => 'required|array|max:2',
        ]);

        StudioBooking::create([
            'name' => $request->name,
            'matrics' => $request->matrics,
            'club' => $request->club,
            'reason' => $request->reason,
            'phone' => $request->phone,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'time_slot' => $request->time_slot,
            'studios' => json_encode($request->studio), // convert array to JSON
        ]);

        return redirect()->back()->with('success', 'Booking submitted successfully!');
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
