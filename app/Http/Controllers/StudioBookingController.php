<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudioBooking;
use App\Models\Outfit;
use App\Models\OutfitBooking;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;    
use Illuminate\Support\Facades\Storage;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

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

    // ✅ Admin: View all studio bookings
    public function indexStudioBookings()
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

    // 👗 User: View Busana booking page
    public function showBusanaPage(Request $request)
    {
        $query = Outfit::query();

        if ($request->has('type') && $request->type !== 'all') {
            $query->where('type', $request->type);
        }

        if ($request->has('gender') && $request->gender !== 'all') {
            $query->where('gender', $request->gender);
        }

        $outfits = $query->get();
        $featuredOutfits = (clone $query)->take(5)->get();

        return view('busana-booking', compact('outfits', 'featuredOutfits'));
    }

    // 👗 Admin: View outfits (busana)
    public function indexOutfits()
    {
        $outfits = Outfit::all();

        if (auth()->check() && auth()->user()->role === 'admin') {
            $bookings = OutfitBooking::with('outfit')->latest()->get();
            return view('admin.outfits.busana-admin', compact('outfits', 'bookings'));
        }

        return view('user.busana', compact('outfits'));
    }

    // 🧾 Submit user booking for busana
    public function storeBusanaBooking(Request $request)
    {
        $request->validate([
            'sizes' => 'required|array',
            'dates' => 'required|array',
            'returns' => 'required|array',
            'name' => 'required|string',
            'matric_no' => 'required|string',
            'club' => 'required|string',
            'purpose' => 'required|string',
            'phone' => 'required|string',
        ]);

        $hasBooking = false;

        foreach ($request->sizes as $outfitId => $size) {
            $bookingDate = $request->dates[$outfitId] ?? null;
            $returnDate = $request->returns[$outfitId] ?? null;

            if (!$size || !$bookingDate || !$returnDate) continue;

            $parsedDate = Carbon::parse($bookingDate);
            if ($parsedDate->lt(Carbon::today()->addDays(3))) continue;

            OutfitBooking::create([
                'outfit_id' => $outfitId,
                'size' => $size,
                'booking_date' => $parsedDate,
                'return_date' => $returnDate,
                'user_id' => auth()->id(),
                'name' => $request->name,
                'matric_no' => $request->matric_no,
                'club' => $request->club,
                'purpose' => $request->purpose,
                'phone' => $request->phone,
                'status' => 'pending',
            ]);

            $hasBooking = true;
        }

        if ($hasBooking) {
            return back()->with('success', 'Your outfit booking(s) have been submitted.');
        }

        return back()->with('error', 'Booking failed. Please select at least one outfit.');
    }

    // ➕ Admin: Create new outfit
    public function createOutfit(Request $request)
    {
        //dd(config('cloudinary'));
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'type' => 'required|string',
            'gender' => 'required|string',
            'status' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = null;

        // ✅ Step 1: Check Cloudinary config before uploading
        $config = config('cloudinary');
        if (!isset($config['cloud']['cloud_name'], $config['cloud']['api_key'], $config['cloud']['api_secret'])) {
            abort(500, 'Cloudinary configuration is missing.');
        }

        $cloudinary = new \Cloudinary\Cloudinary([
            'cloud' => [
                'cloud_name' => $config['cloud']['cloud_name'],
                'api_key'    => $config['cloud']['api_key'],
                'api_secret' => $config['cloud']['api_secret'],
            ],
        ]);

        // ✅ Step 2: Upload image if provided
        if ($request->hasFile('image')) {
            $uploadedFile = $request->file('image');
            $uploadResult = $cloudinary->uploadApi()->upload($uploadedFile->getRealPath());
            $imagePath = $uploadResult['secure_url'] ?? null;
        }

        // ✅ Step 3: Create outfit entry
        Outfit::create([
            'name' => $request->name,
            'description' => $request->description,
            'type' => $request->type,
            'gender' => $request->gender,
            'status' => $request->status,
            'available_sizes' => json_encode($request->available_sizes ?? []),
            'image_path' => $imagePath,
            'is_featured' => false,
        ]);

        // Inside createOutfit()
        return back()->with('success', 'Outfit added successfully.');
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

    // ✏️ Admin: Edit outfit
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
            'type' => 'required|string',
            'gender' => 'required|string',
            'status' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'available_sizes' => 'required|array',
        ]);

        if ($request->hasFile('image')) {
            $uploadedImage = Cloudinary::upload($request->file('image')->getRealPath());
            $imageUrl = $uploadedImage->getSecurePath();

            $outfit->image_path = $imageUrl;
        }

        $outfit->update([
            'name' => $request->name,
            'description' => $request->description,
            'type' => $request->type,
            'gender' => $request->gender,
            'status' => $request->status,
            'available_sizes' => json_encode($request->available_sizes ?? []),
            'image_path' => $outfit->image_path,
        ]);

        return redirect()->route('busana')->with('success', 'Outfit updated successfully!');
    }

    // 🧾 Admin: View all outfit bookings
    public function viewOutfitBookings()
    {
        $bookings = OutfitBooking::with('outfit')->latest()->get();
        return view('admin.outfits.outfit-bookings', compact('bookings'));
    }

    // ✅ Admin: Accept outfit booking
    public function acceptOutfitBooking($id)
    {
        $booking = \App\Models\OutfitBooking::findOrFail($id);
        $booking->status = 'accepted';
        $booking->save();

        return back()->with('booking_success', '✅ Booking accepted successfully.');
    }

    public function rejectOutfitBooking($id)
    {
        $booking = \App\Models\OutfitBooking::findOrFail($id);
        $booking->status = 'rejected';
        $booking->save();

        return back()->with('booking_success', '❌ Booking rejected.');
    }

    public function handleDecision(Request $request, $id)
    {
        $booking = OutfitBooking::findOrFail($id);
        $decision = $request->input('decision');

        if (in_array($decision, ['accepted', 'rejected'])) {
            $booking->status = $decision;
            $booking->save();

            return redirect()->back()->with('success', "Booking has been {$decision}.");
        }

        return redirect()->back()->with('error', 'Invalid decision.');
    }

    // 👀 Preview booking confirmation (before final submit)
    public function confirmPreview(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'matric_no' => 'required|string',
            'club' => 'required|string',
            'purpose' => 'required|string',
            'phone' => 'required|string',
            'sizes' => 'required|array',
            'dates' => 'required|array',
            'returns' => 'required|array',
        ]);

        $filteredSizes = [];
        $filteredDates = [];
        $filteredReturns = [];

        foreach ($validated['sizes'] as $id => $size) {
            if ($size && !empty($validated['dates'][$id]) && !empty($validated['returns'][$id])) {
                $filteredSizes[$id] = $size;
                $filteredDates[$id] = $validated['dates'][$id];
                $filteredReturns[$id] = $validated['returns'][$id];
            }
        }

        if (empty($filteredSizes)) {
            return redirect()->route('busana')->with('error', '⚠️ Please select at least one outfit with all required fields.');
        }

        $cleanData = [
            'name' => $validated['name'],
            'matric_no' => $validated['matric_no'],
            'club' => $validated['club'],
            'purpose' => $validated['purpose'],
            'phone' => $validated['phone'],
            'sizes' => $filteredSizes,
            'dates' => $filteredDates,
            'returns' => $filteredReturns,
        ];

        session(['booking_preview' => $cleanData]);

        $outfits = Outfit::whereIn('id', array_keys($filteredSizes))->get();

        return view('user.busana-confirm', [
            'data' => $cleanData,
            'outfits' => $outfits,
        ]);
    }

    // ✅ Final submit (after confirmation)
    public function finalSubmit(Request $request)
    {
        $data = session('booking_preview');

        if (!$data) {
            return redirect()->route('busana')->with('error', 'Session expired. Please submit again.');
        }

        $userId = auth()->id();
        $hasBooking = false;

        foreach ($data['sizes'] as $outfitId => $size) {
            $outfit = \App\Models\Outfit::find($outfitId);

            if (!$outfit) continue;

            $bookingDate = $data['dates'][$outfitId] ?? null;
            $returnDate = $data['returns'][$outfitId] ?? null;

            $isAccessories = $outfit->type === 'accessories';

            if ($bookingDate && $returnDate && ($isAccessories || $size)) {
                \App\Models\OutfitBooking::create([
                    'outfit_id' => $outfitId,
                    'user_id' => $userId,
                    'name' => $data['name'],
                    'matric_no' => $data['matric_no'],
                    'club' => $data['club'],
                    'purpose' => $data['purpose'],
                    'phone' => $data['phone'],
                    'size' => $isAccessories ? 'N/A' : $size,
                    'booking_date' => $bookingDate,
                    'return_date' => $returnDate,
                    'status' => 'pending',
                ]);
                $hasBooking = true;
            }
        }

        session()->forget('booking_preview');

    return $hasBooking
        ? redirect()->route('busana')->with('success', '✅ Booking submitted successfully!')
        : redirect()->route('busana')->with('error', '❌ No valid outfit booking found.');
}


    // View image for welcome page
    public function dashboard()
    {
        $outfits = \App\Models\Outfit::select('name', 'image_path')->get();

    return view('dashboard', [
        'outfits' => $outfits,
    ]);
}

}// End of StudioBookingController
