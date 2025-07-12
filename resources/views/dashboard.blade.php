@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold">Vestario</h1>
        <p class="text-muted">Welcome to your fashion booking dashboard!</p>
    </div>

    <!-- Hero Image -->
    <div class="mb-5 d-flex justify-content-center">
        <img src="{{ asset('images/hero.png') }}" class="img-fluid rounded shadow" style="max-height: 400px;" alt="Hero Image">
    </div>

    <!-- Search Bar -->
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <input type="text" class="form-control form-control-lg rounded-pill shadow-sm" placeholder="Search for fashion, styles, or brands...">
        </div>
    </div>

    <!-- Image Gallery -->
    <div class="row flex-nowrap overflow-auto pb-3">
        @foreach (['fashion1', 'fashion2', 'fashion3', 'fashion4', 'fashion5'] as $tag)
        <div class="col-auto">
            <img src="https://source.unsplash.com/300x400/?{{ $tag }}" class="rounded shadow-sm me-3" style="width: 300px; height: 400px; object-fit: cover;" alt="{{ ucfirst($tag) }}">
        </div>
        @endforeach
    </div>
</div>
@endsection