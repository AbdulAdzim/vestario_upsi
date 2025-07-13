@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold">Vestario</h1>
        <p class="text-muted">Welcome to Vestario, All easy to use booking busana and studio in UPSI</p>
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