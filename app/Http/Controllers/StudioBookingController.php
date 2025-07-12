<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudioBooking;
use App\Models\Outfit;
use App\Models\OutfitBooking;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudioBookingController extends Controller
{
    // 🎯 User: Submit studio booking
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
            'studios' => json_encode($request->studio),
        ]);

        return redirect()->back()->with('success', 'Booking submitted successfully!');
    }

    // 👗 User: Submit Busana (Outfit) booking form
    public function storeBusanaBooking(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'matric_no' => 'required|string',
            'club' => 'required|string',
            'purpose' => 'required|string',
            'phone' => 'required|string',
            'return_date' => 'required|date|after_or_equal:today',
            'sizes' => 'required|array',
            'dates' => 'required|array',
        ]);

        foreach ($request->sizes as $outfitId => $size) {
            $bookingDate = $request->dates[$outfitId] ?? null;
            if (!$size || !$bookingDate) continue;

            $parsedDate = Carbon::parse($bookingDate);

            if ($parsedDate->lt(Carbon::today()->addDays(3))) {
                continue; // must be at least 3 working days in advance
            }

            OutfitBooking::create([
                'outfit_id' => $outfitId,
                'size' => $size,
                'booking_date' => $parsedDate,
                'return_date' => $request->return_date,
                'user_id' => auth()->id(),
                'name' => $request->name,
                'matric_no' => $request->matric_no,
                'club' => $request->club,
                'purpose' => $request->purpose,
                'phone' => $request->phone,
            ]);
        }

        return back()->with('success', 'Your outfit booking(s) have been submitted.');
    }

    // 🛠️ Admin: View all studio bookings
    public function index()
    {
        $bookings = StudioBooking::all();
        return view('admin.bookings.index', compact('bookings'));
    }

    // 🛠️ Admin: Accept or reject a studio booking
    public function updateStatus($id, $status)
    {
        $booking = StudioBooking::findOrFail($id);
        $booking->status = $status;
        $booking->save();

        return redirect()->route('admin.bookings')->with('success', 'Booking status updated.');
    }

    // 👗 User: View Busana (Outfit) booking page
    public function showBusanaPage(Request $request)
{
    $query = Outfit::query();

    if ($request->type && $request->type !== 'all') {
        $query->where('type', $request->type);
    }

    if ($request->gender && $request->gender !== 'all') {
        $query->where('gender', $request->gender);
    }

    $outfits = $query->get();
    $featuredOutfits = Outfit::take(5)->get();

    return view('busana', compact('outfits', 'featuredOutfits'));
}


    // ✅ Admin: Create new outfit
    public function createOutfit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('outfits', 'public');
        }

        Outfit::create([
    'name' => $request->name,
    'description' => $request->description,
    'image_path' => $imagePath,
    'type' => $request->type,
    'gender' => $request->gender,
    'is_featured' => false,
        ]);


        return back()->with('success', 'Outfit added!');
    }

    // 🗑️ Admin: Delete outfit
    public function deleteOutfit($id)
    {
        $outfit = Outfit::findOrFail($id);
        if ($outfit->image_path) {
            Storage::disk('public')->delete($outfit->image_path);
        }
        $outfit->delete();

        return back()->with('success', 'Outfit deleted.');
    }

    //admin edit outfit
    public function editOutfit($id)
{
    $outfit = Outfit::findOrFail($id);
    return view('admin.outfits.edit', compact('outfit'));
}

public function updateOutfit(Request $request, $id)
{
    $outfit = Outfit::findOrFail($id);

    $request->validate([
        'name' => 'required',
        'description' => 'nullable',
        'status' => 'nullable',
        'image' => 'nullable|image|max:2048',
    ]);

    // Handle image replacement
    if ($request->hasFile('image')) {
        if ($outfit->image_path) {
            \Storage::disk('public')->delete($outfit->image_path);
        }

        $outfit->image_path = $request->file('image')->store('outfits', 'public');
    }

    // Assign updated values
    $outfit->name = $request->name;
    $outfit->description = $request->description;
    $outfit->status = $request->status;

    $outfit->save(); // ✅ This line updates the existing record

    return redirect()->route('busana')->with('success', 'Outfit updated successfully!');
}

}
