@extends('layouts.app')

@section('title', 'Confirm Busana Booking')

@section('content')
<style>
    .section-card {
        background: #ffffff;
        border-radius: 1rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        padding: 30px;
        margin-bottom: 2rem;
    }

    .section-title {
        font-size: 1.4rem;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 1.2rem;
        border-left: 5px solid #0d6efd;
        padding-left: 0.75rem;
    }

    .info-list li {
        margin-bottom: 0.5rem;
    }

    .outfit-item {
        display: flex;
        align-items: flex-start;
        gap: 20px;
        padding: 1rem 0;
        border-bottom: 1px solid #e9ecef;
    }

    .outfit-item:last-child {
        border-bottom: none;
    }

    .outfit-img {
        width: 120px;
        height: 100px;
        object-fit: cover;
        border-radius: 0.5rem;
    }

    .outfit-details h6 {
        font-weight: 600;
        margin-bottom: 0.3rem;
    }

    .btn-group-separated {
        display: flex;
        justify-content: space-between;
        margin-top: 30px;
    }

    .btn-final, .btn-back {
        padding: 12px 30px;
        font-weight: 600;
        font-size: 15px;
        border-radius: 8px;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-final {
        background-color: #198754;
        color: #fff;
    }

    .btn-final:hover {
        background-color: #157347;
        transform: translateY(-1px);
    }

    .btn-back {
        background-color: #6c757d;
        color: #fff;
    }

    .btn-back:hover {
        background-color: #5a6268;
        transform: translateY(-1px);
    }
</style>

<div class="container my-5">
    <h2 class="text-primary text-center fw-bold mb-5">Confirm Your Booking</h2>

    <!-- Applicant Information -->
    <div class="section-card">
        <div class="section-title">Applicant Information</div>
        <ul class="info-list list-unstyled">
            <li><strong>Full Name:</strong> {{ $data['name'] }}</li>
            <li><strong>Matric / Staff No:</strong> {{ $data['matric_no'] }}</li>
            <li><strong>Club / Association:</strong> {{ $data['club'] }}</li>
            <li><strong>Purpose:</strong> {{ $data['purpose'] }}</li>
            <li><strong>Phone:</strong> {{ $data['phone'] }}</li>
        </ul>
    </div>

    <!-- Outfit Selection -->
    <div class="section-card">
        <div class="section-title">Outfit Selections</div>
        @forelse($outfits as $outfit)
            <div class="outfit-item">
                @if ($outfit->image_path)
                    <img src="{{ $outfit->image_path }}" alt="Outfit Image" class="outfit-img">
                @endif
                <div class="outfit-details">
                    <h6>{{ $outfit->name }}</h6>
                    <p class="text-muted mb-1">{{ $outfit->description }}</p>
                    <ul class="list-unstyled mb-0">
                        <li><strong>Size:</strong> {{ $data['sizes'][$outfit->id] }}</li>
                        <li><strong>Booking Date:</strong> {{ $data['dates'][$outfit->id] }}</li>
                        <li><strong>Return Date:</strong> {{ $data['returns'][$outfit->id] }}</li>
                    </ul>
                </div>
            </div>
        @empty
            <p class="text-danger">No outfits selected.</p>
        @endforelse
    </div>

    <!-- Buttons -->
    <form action="{{ route('busana.final') }}" method="POST">
        @csrf
        <div class="btn-group-separated">
            <a href="{{ route('busana') }}" class="btn btn-back">&larr; Back to Booking</a>
            <button type="submit" class="btn btn-final">Confirm Booking</button>
        </div>
    </form>
</div>
@endsection
