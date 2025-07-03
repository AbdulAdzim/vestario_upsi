@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Admin Dashboard</h2>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card border-primary">
                <div class="card-body">
                    <h5 class="card-title">Total Bookings</h5>
                    <p class="card-text display-6">{{ $total }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-success">
                <div class="card-body">
                    <h5 class="card-title">Approved</h5>
                    <p class="card-text display-6">{{ $accepted }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-warning">
                <div class="card-body">
                    <h5 class="card-title">Pending</h5>
                    <p class="card-text display-6">{{ $pending }}</p>
                </div>
            </div>
        </div>
    </div>

    <a href="{{ route('admin.bookings') }}" class="btn btn-primary">Manage Bookings</a>
</div>
@endsection
