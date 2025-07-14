@extends('layouts.app')

@section('content')
<div class="container mt-5">

    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold">Vestario Dashboard</h1>
        <p class="text-muted">Manage Booking More Effectively.</p>
    </div>

    <div class="text-center mb-5">
        <h1 class="text-muted">Welcome, {{ Auth::user()->name }}</h1>
    </div>

</div>
@endsection
