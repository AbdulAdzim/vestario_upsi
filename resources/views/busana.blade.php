@extends('layouts.app')

@section('title', 'Busana Booking')

@section('content')
<div class="container mt-5">
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold">Busana</h1>
        <p class="text-muted">Book your clothing now</p>
    </div>

    <!-- 🧽 Filters -->
    <div class="mb-3">
        <h5>Filter by Type:</h5>
        <div class="btn-group mb-2">
            @foreach(['all', 'fullset', 'accessories', 'top', 'bottom'] as $type)
                <a href="?type={{ $type }}" class="btn btn-outline-primary">{{ ucfirst($type) }}</a>
            @endforeach
        </div>

        <h5>Filter by Gender:</h5>
        <div class="btn-group mb-4">
            @foreach(['all', 'male', 'female'] as $gender)
                <a href="?gender={{ $gender }}" class="btn btn-outline-secondary">{{ ucfirst($gender) }}</a>
            @endforeach
        </div>
    </div>

    <!-- 🗘️ User Booking Form -->
    @auth
        @if(auth()->user()->role !== 'admin')
            <form action="{{ route('busana.book') }}" method="POST">
                @csrf
                <h3>📌 Applicant Information</h3>
                <label>Full Name:</label>
                <input type="text" name="name" required class="form-control mb-2">
                <label>Matric / Staff Number:</label>
                <input type="text" name="matric_no" required class="form-control mb-2">
                <label>Club / Association:</label>
                <input type="text" name="club" required class="form-control mb-2">
                <label>Purpose of Application:</label>
                <textarea name="purpose" required class="form-control mb-2"></textarea>
                <label>Phone Number:</label>
                <input type="text" name="phone" required class="form-control mb-4">

                <hr>
                <h3>🎽 Select Outfit(s)</h3>

                @foreach($outfits as $outfit)
                    <div class="outfit-card">
                        <div class="outfit-title">{{ $outfit->name }}</div>
                        <div>{{ $outfit->description }}</div>

                        @if($outfit->image_path)
                            <img src="{{ asset('storage/' . $outfit->image_path) }}" alt="Preview" style="height: 120px; border-radius: 8px; margin: 10px 0;">
                        @endif

                        <span class="status-badge {{ $outfit->status === 'not available' ? 'not-available' : 'available' }}">
                            {{ ucfirst($outfit->status ?? 'available') }}
                        </span>

                        @if($outfit->status !== 'not available')
                            <div class="form-row">
                                <label>Pick Size:</label>
                                <select name="sizes[{{ $outfit->id }}]" class="form-control">
                                    <option value="">-- Select --</option>
                                    @foreach(['S', 'M', 'L', 'XL', 'XXL'] as $size)
                                        <option value="{{ $size }}">{{ $size }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-row mt-2">
                                <label>Booking Date:</label>
                                <input type="date" name="dates[{{ $outfit->id }}]"
                                       min="{{ \Carbon\Carbon::today()->addDays(3)->toDateString() }}"
                                       max="{{ \Carbon\Carbon::today()->addDays(14)->toDateString() }}"
                                       class="form-control">
                            </div>
                            <div class="form-row mt-2">
                                <label>Return Date:</label>
                                <input type="date" name="returns[{{ $outfit->id }}]"
                                       min="{{ \Carbon\Carbon::today()->addDays(4)->toDateString() }}"
                                       max="{{ \Carbon\Carbon::today()->addDays(21)->toDateString() }}"
                                       class="form-control">
                            </div>
                        @else
                            <div class="form-row text-danger fw-bold mt-2">❌ Not available for booking.</div>
                        @endif
                    </div>
                @endforeach

                <button type="submit" class="btn btn-primary mt-4">📩 Submit Booking</button>
            </form>
        @endif
    @endauth
</div>

<style>
    .outfit-card {
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 25px;
        background-color: #fff;
        transition: 0.3s ease-in-out;
    }

    .outfit-card:hover {
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
    }

    .outfit-title {
        font-size: 18px;
        font-weight: 600;
        color: #333;
        margin-bottom: 5px;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
        margin-top: 8px;
    }

    .available {
        background-color: #d1e7dd;
        color: #0f5132;
    }

    .not-available {
        background-color: #f8d7da;
        color: #842029;
    }
</style>
@endsection
