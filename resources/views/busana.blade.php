@extends('layouts.app')

@section('title', 'Busana')

@section('content')
<div class="container mt-5">
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold">Busana</h1>
        <p class="text-muted">Book your clothing now</p>
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
        @foreach (['baju1', 'baju2', 'baju3', 'baju4', 'baju5'] as $tag)
        <div class="col-auto">
            <img src="{{ asset('images/hero.png') }}" class="rounded shadow-sm me-3" style="width: 300px; height: 400px; object-fit: cover;" alt="{{ ucfirst($tag) }}">
        </div>
        @endforeach
    </div>
    <div class="row flex-nowrap overflow-auto pb-3">
        @foreach (['seluar1', 'seluar2', 'seluar3', 'seluar4', 'seluar5'] as $tag)
        <div class="col-auto">
            <img src="{{ asset('images/hero.png') }}" class="rounded shadow-sm me-3" style="width: 300px; height: 400px; object-fit: cover;" alt="{{ ucfirst($tag) }}">
        </div>
        @endforeach
    </div>
</div>
@endsection
