@extends('layouts.admin')

@section('title', 'Edit Outfit')

@section('content')
<div class="container mt-4">
    <h1 class="display-5 fw-bold mb-4">✏️ Edit Outfit</h1>

    <form action="{{ route('outfit.update', $outfit->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input type="text" name="name" value="{{ $outfit->name }}" required class="form-control mb-2">
        <textarea name="description" class="form-control mb-2">{{ $outfit->description }}</textarea>

        <label>Category:</label><br>
        @foreach(['fullset', 'accessories', 'top', 'bottom'] as $type)
            <label><input type="radio" name="type" value="{{ $type }}" {{ $outfit->type === $type ? 'checked' : '' }}> {{ ucfirst($type) }}</label>
        @endforeach

        <br><label>Gender:</label><br>
        <label><input type="radio" name="gender" value="male" {{ $outfit->gender === 'male' ? 'checked' : '' }}> Male</label>
        <label><input type="radio" name="gender" value="female" {{ $outfit->gender === 'female' ? 'checked' : '' }}> Female</label>

        <br><label>Status:</label><br>
        <label><input type="radio" name="status" value="available" {{ $outfit->status === 'available' ? 'checked' : '' }}> Available</label>
        <label><input type="radio" name="status" value="not available" {{ $outfit->status === 'not available' ? 'checked' : '' }}> Not Available</label>

        <br><label>Available Sizes:</label><br>
        @php
            $availableSizes = json_decode($outfit->available_sizes ?? '[]');
        @endphp
        @foreach(['S', 'M', 'L', 'XL', 'XXL'] as $size)
            <label>
                <input type="checkbox" name="available_sizes[]" value="{{ $size }}" {{ in_array($size, $availableSizes) ? 'checked' : '' }}>
                {{ $size }}
            </label>
        @endforeach

        <br><label>Upload New Image (optional):</label>
        <input type="file" name="image" class="form-control mb-2">
        @if($outfit->image_path)
            <img src="{{ asset('storage/' . $outfit->image_path) }}" width="120" class="mt-2">
        @endif

        <button type="submit" class="btn btn-primary mt-3">Update Outfit</button>
        <a href="{{ route('busana') }}" class="btn btn-secondary mt-3">Back</a>

        
    </form>
</div>
@endsection
