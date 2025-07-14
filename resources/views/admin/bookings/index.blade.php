@extends('layouts.admin')

@section('title', 'Booking Requested Dashboard')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Booking Requested Dashboard</h2>

    @foreach ($bookings as $booking)
        <div class="border p-4 mb-4 rounded shadow-sm bg-white">
            <p><strong>Name:</strong> {{ $booking->name }}</p>
            <p><strong>Matrics:</strong> {{ $booking->matrics }}</p>
            <p><strong>Club:</strong> {{ $booking->club }}</p>
            <p><strong>Reason:</strong> {{ $booking->reason }}</p>
            <p><strong>Studio(s):</strong> {{ $booking->studio }}</p>
            <p><strong>Date:</strong> {{ $booking->start_date }} to {{ $booking->end_date }}</p>
            <p><strong>Time:</strong> {{ $booking->time_slot }}</p>
            <p><strong>Status:</strong>
                @if ($booking->status == 'pending')
                    <span class="text-warning">Pending</span>
                @elseif ($booking->status == 'accepted')
                    <span class="text-success">Accepted</span>
                @else
                    <span class="text-danger">Rejected</span>
                @endif
            </p>

            @if ($booking->status === 'pending')
                <form method="POST" action="{{ route('admin.bookings.accept', $booking->id) }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-success btn-sm">Accept</button>
                </form>
                <form method="POST" action="{{ route('admin.bookings.reject', $booking->id) }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                </form>
            @endif
        </div>
    @endforeach
</div>
@endsection
