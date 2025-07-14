@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="row mb-4">
        <!-- Studio Stats -->
        <div class="col-md-6">
            <div class="card border-info mb-3">
                <div class="card-header bg-info text-white">Studio Bookings</div>
                <div class="card-body">
                    <p class="card-text">Total: <strong>{{ $studioTotal }}</strong></p>
                    <p class="card-text">Approved: <strong>{{ $studioAccepted }}</strong></p>
                    <p class="card-text">Pending: <strong>{{ $studioPending }}</strong></p>
                </div>
            </div>
        </div>

        <!-- Busana Stats -->
        <div class="col-md-6">
            <div class="card border-secondary mb-3">
                <div class="card-header bg-secondary text-white">Busana Bookings</div>
                <div class="card-body">
                    <p class="card-text">Total: <strong>{{ $busanaTotal }}</strong></p>
                    <p class="card-text">Approved: <strong>{{ $busanaAccepted }}</strong></p>
                    <p class="card-text">Pending: <strong>{{ $busanaPending }}</strong></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
