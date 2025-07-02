<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudioBooking;

class AdminBookingController extends Controller
{
    public function index()
    {
        $bookings = StudioBooking::orderBy('created_at', 'desc')->get();
        return view('admin.bookings.index', compact('bookings'));
    }

    public function accept($id)
    {
        $booking = StudioBooking::findOrFail($id);
        $booking->status = 'accepted';
        $booking->save();

        return back()->with('success', 'Booking accepted.');
    }

    public function reject($id)
    {
        $booking = StudioBooking::findOrFail($id);
        $booking->status = 'rejected';
        $booking->save();

        return back()->with('success', 'Booking rejected.');
    }
}
