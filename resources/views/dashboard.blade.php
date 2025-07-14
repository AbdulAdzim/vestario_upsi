@extends('layouts.app')

@section('content')
<div class="container mt-5">

    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold">Vestario Dashboard</h1>
        <p class="text-muted">Manage and preview Busana outfits below.</p>
    </div>

    <div class="row flex-nowrap overflow-auto pb-3">
        @foreach ($outfits as $outfit)
        <div class="col-auto">
            <img src="{{ asset('storage/outfits/' . $outfit->image) }}"
                 alt="{{ $outfit->name }}"
                 class="rounded shadow-sm me-3"
                 style="width: 300px; height: 400px; object-fit: cover;">
        </div>
        @endforeach
    </div>

</div>
@endsection
