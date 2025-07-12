@extends('layouts.app')

@section('title', 'Edit Outfit')

@section('content')
<div class="container mt-5">
    <h2>Edit Outfit</h2>

    <form action="{{ route('outfit.update', $outfit->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Outfit Name:</label>
            <input type="text" name="name" value="{{ $outfit->name }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description:</label>
            <textarea name="description" class="form-control">{{ $outfit->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Category:</label><br>
            @foreach(['fullset', 'accessories', 'top', 'bottom'] as $type)
                <label>
                    <input type="radio" name="type" value="{{ $type }}" {{ $outfit->type === $type ? 'checked' : '' }}>
                    {{ ucfirst($type) }}
                </label>
            @endforeach
        </div>

        <div class="mb-3">
            <label>Gender:</label><br>
            <label><input type="radio" name="gender" value="male" {{ $outfit->gender === 'male' ? 'checked' : '' }}> Male</label>
            <label><input type="radio" name="gender" value="female" {{ $outfit->gender === 'female' ? 'checked' : '' }}> Female</label>
        </div>

        <div class="mb-3">
            <label>Status:</label><br>
            <label><input type="radio" name="status" value="available" {{ $outfit->status !== 'not available' ? 'checked' : '' }}> Available</label>
            <label><input type="radio" name="status" value="not available" {{ $outfit->status === 'not available' ? 'checked' : '' }}> Not Available</label>
        </div>

        <div class="mb-3">
            @if($outfit->image_path)
                <img src="{{ asset('storage/' . $outfit->image_path) }}" alt="Current Image" style="height: 100px; border-radius: 6px;"><br><br>
            @endif
            <label for="image">Replace Image (optional):</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update Outfit</button>
        <a href="{{ route('busana') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
