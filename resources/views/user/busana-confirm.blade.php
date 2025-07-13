@extends('layouts.app')

@section('title', 'Confirm Busana Booking')

@section('content')
<style>
    .card {
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        border-radius: 12px;
        padding: 20px;
        background-color: #fff;
        margin-bottom: 30px;
    }

    .section-title {
        font-size: 1.3rem;
        font-weight: 600;
        color: #374151;
        border-bottom: 2px solid #e5e7eb;
        padding-bottom: 6px;
        margin-bottom: 20px;
    }

    .info-list {
        font-size: 15px;
        line-height: 1.6;
    }

    .outfit-img {
        width: 110px;
        height: 100px;
        object-fit: cover;
        border-radius: 8px;
        margin-right: 15px;
    }

    .btn-final, .btn-back {
        padding: 10px 25px;
        font-weight: 500;
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

    .btn-group-separated {
        display: flex;
        justify-content: space-between;
        margin-top: 30px;
    }

    .card-title {
        margin-bottom: 5px;
        font-size: 16px;
        font-weight: 600;
    }
</style>

<div class="container my-5">
    <h2 class="mb-4 text-primary">📝 Confirm Your Booking</h2>

    <div class="card">
        <div class="section-title">👤 Applicant Information</div>
        <ul class="info-list list-unstyled">
            <li><strong>Name:</strong> {{ $data['name'] }}</li>
            <li><strong>Matric No:</strong> {{ $data['matric_no'] }}</li>
            <li><strong>Club:</strong> {{ $data['club'] }}</li>
            <li><strong>Purpose:</strong> {{ $data['purpose'] }}</li>
            <li><strong>Phone:</strong> {{ $data['phone'] }}</li>
        </ul>
    </div>

    <div class="card">
        <div class="section-title">🎽 Outfit Selections</div>
        @foreach($outfits as $outfit)
            <div class="d-flex align-items-start mb-4">
                @if($outfit->image_path)
                    <img src="{{ asset('storage/' . $outfit->image_path) }}" alt="Outfit Image" class="outfit-img">
                @endif
                <div>
                    <h5 class="card-title">{{ $outfit->name }}</h5>
                    <p class="text-muted">{{ $outfit->description }}</p>
                    <ul class="info-list list-unstyled">
                        <li><strong>Size:</strong> {{ $data['sizes'][$outfit->id] }}</li>
                        <li><strong>Booking Date:</strong> {{ $data['dates'][$outfit->id] }}</li>
                        <li><strong>Return Date:</strong> {{ $data['returns'][$outfit->id] }}</li>
                    </ul>
                </div>
            </div>
        @endforeach
    </div>

    <form action="{{ route('busana.final') }}" method="POST">
        @csrf
        <div class="btn-group-separated">
            <a href="{{ route('busana') }}" class="btn btn-back">← Back to Booking</a>
            <button type="submit" class="btn btn-final">✅ Confirm Booking</button>
        </div>
    </form>
</div>
@endsection
