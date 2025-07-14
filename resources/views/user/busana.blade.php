@extends('layouts.app')

@section('title', 'Busana Booking')

@section('content')
<div class="container my-5">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            ❌ {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h2 class="text-center mb-5 fw-bold">Busana Booking</h2>

    @auth
        @if(auth()->user()->role !== 'admin')
        <form action="{{ route('busana.confirm') }}" method="POST" id="bookingForm">
            @csrf

            <div class="row g-4">
                <!-- 👤 User Info -->
                <div class="col-lg-4">
                    <div class="bg-white p-4 rounded-4 shadow-sm">
                        <h5 class="fw-bold mb-3">Personal Information</h5>
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Matric / Staff No</label>
                            <input type="text" name="matric_no" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Club / Association</label>
                            <input type="text" name="club" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Purpose</label>
                            <textarea name="purpose" rows="3" class="form-control" required></textarea>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary w-100 fw-semibold">
                                Preview & Submit
                            </button>
                        </div>
                    </div>
                </div>

                <!-- 🎽 Outfit Grid -->
                <div class="col-lg-8">
                    <div class="bg-white p-4 rounded-4 shadow-sm">
                        <div class="mb-4">
                            <h5 class="fw-bold">Select Your Outfit</h5>
                            <!-- Filter: Type -->
                            <div class="mb-2">
                                <strong>Type:</strong>
                                @foreach(['all', 'fullset', 'accessories', 'top', 'bottom'] as $type)
                                    <a href="?type={{ $type }}{{ request('gender') ? '&gender=' . request('gender') : '' }}"
                                    class="btn btn-sm {{ request('type', 'all') === $type ? 'btn-primary' : 'btn-outline-primary' }}">
                                        {{ ucfirst($type) }}
                                    </a>
                                @endforeach
                            </div>
                            <!-- Filter: Gender -->
                            <div class="mb-3">
                                <strong>Gender:</strong>
                                @foreach(['all', 'male', 'female'] as $gender)
                                    <a href="?gender={{ $gender }}{{ request('type') ? '&type=' . request('type') : '' }}"
                                    class="btn btn-sm {{ request('gender', 'all') === $gender ? 'btn-secondary' : 'btn-outline-secondary' }}">
                                        {{ ucfirst($gender) }}
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                            @foreach($outfits as $outfit)
                                @if($outfit->status === 'available')
                                    <div class="col">
                                        <div class="card h-100 border-0 shadow-sm rounded-4">
                                            <img src="{{ asset('storage/' . $outfit->image_path) }}" class="card-img-top rounded-top-4" alt="{{ $outfit->name }}" style="object-fit: cover; height: 200px;">
                                            <div class="card-body d-flex flex-column">
                                                <h6 class="fw-semibold mb-1">{{ $outfit->name }}</h6>
                                                <p class="text-muted small">{{ Str::limit($outfit->description, 50) }}</p>

                                                @if($outfit->type !== 'accessories')
                                                    <label class="form-label small">Size</label>
                                                    <select name="sizes[{{ $outfit->id }}]" class="form-select mb-2">
                                                        <option value="">-- Select Size --</option>
                                                        @foreach(json_decode($outfit->available_sizes ?? '[]') as $size)
                                                            <option value="{{ $size }}">{{ $size }}</option>
                                                        @endforeach
                                                    </select>
                                                @else
                                                    <input type="hidden" name="sizes[{{ $outfit->id }}]" value="N/A">
                                                @endif

                                                <label class="form-label small">Booking Date</label>
                                                <input type="date" name="dates[{{ $outfit->id }}]" class="form-control mb-2">

                                                <label class="form-label small">Return Date</label>
                                                <input type="date" name="returns[{{ $outfit->id }}]" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </form>
        @endif
    @endauth
</div>
@endsection
