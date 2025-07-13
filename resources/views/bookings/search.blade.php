@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center">Check Your Booking Status</h2>

    <form method="POST" action="{{ route('bookings.search.result') }}" class="mb-5">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label for="matrics">Matrics No:</label>
                <input type="text" name="matrics" id="matrics" class="form-control" required value="{{ old('matrics', $matrics ?? '') }}">
            </div>
            <div class="col-md-6">
                <label for="type">Booking Type:</label>
                <select name="type" id="type" class="form-control">
                    <option value="studio" {{ (old('type', $type ?? '') == 'studio') ? 'selected' : '' }}>Studio</option>
                    <option value="busana" {{ (old('type', $type ?? '') == 'busana') ? 'selected' : '' }}>Busana</option>
                </select>
            </div>
        </div>

        <button class="btn btn-primary mt-3">Search</button>
    </form>

    @isset($results)
        <h4>Search Results</h4>
        @if ($results->count() > 0)
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Booking ID</th>
                        <th>Type</th>
                        <th>Reason</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($results as $booking)
                        <tr>
                            <td>{{ $booking->id }}</td>
                            <td>{{ ucfirst($booking->type) }}</td>
                            <td>{{ $booking->reason }}</td>
                            <td>{{ $booking->start_date }} - {{ $booking->end_date }}</td>
                            <td>{{ $booking->time_slot }}</td>
                            <td>
                                <span class="badge bg-{{ $booking->status === 'accepted' ? 'success' : ($booking->status === 'rejected' ? 'danger' : 'warning') }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No bookings found for the given information.</p>
        @endif
    @endisset
</div>
@endsection
