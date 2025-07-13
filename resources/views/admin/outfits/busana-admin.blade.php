@extends('layouts.admin')

@section('content')
<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .container {
        max-width: 960px;
        margin: auto;
        padding: 20px;
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
    }

    .outfit-card {
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 25px;
        background-color: #fff;
        transition: 0.3s ease-in-out;
    }

    .outfit-card:hover {
        box-shadow: 0 4px 16px rgba(0,0,0,0.08);
    }

    .outfit-title {
        font-size: 18px;
        font-weight: 600;
        color: #333;
        margin-bottom: 5px;
    }

    input[type="text"],
    input[type="date"],
    textarea,
    select {
        width: 100%;
        padding: 8px 12px;
        border-radius: 6px;
        border: 1px solid #ccc;
        font-size: 14px;
        box-sizing: border-box;
    }

    label {
        font-weight: 500;
        margin-top: 10px;
        display: block;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
        margin-top: 8px;
    }

    .available {
        background-color: #d1e7dd;
        color: #0f5132;
    }

    .not-available {
        background-color: #f8d7da;
        color: #842029;
    }

    button {
        padding: 8px 16px;
        border-radius: 6px;
        font-weight: 600;
        margin-top: 15px;
        cursor: pointer;
    }

    button[type="submit"] {
        background-color: #007bff;
        color: white;
        border: none;
    }

    button[type="submit"]:hover {
        background-color: #0056b3;
    }

    a.edit-link {
        margin-left: 10px;
        color: blue;
        text-decoration: underline;
    }

    img {
        max-width: 100%;
        border-radius: 10px;
        margin: 10px 0;
    }

    hr {
        margin: 40px 0 30px;
    }

    h3 {
        margin-top: 30px;
        font-weight: 600;
        color: #333;
    }

    /* Add form toggle */
    #addForm {
        display: none;
        margin-bottom: 30px;
    }

    #addForm.show {
        display: block;
    }

    .add-btn {
        background-color: #28a745;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 6px;
        font-weight: 600;
        margin-bottom: 20px;
        cursor: pointer;
    }

    .add-btn:hover {
        background-color: #218838;
    }
</style>

<div class="container mt-4">
    <h1 class="display-5 fw-bold mb-4">🧵 Manage Busana</h1>

    @if ($outfits->count() > 0)
        <button class="add-btn" onclick="toggleAddForm()">+ Add New Outfit</button>
    @endif

    <!-- ✅ Add New Outfit Form -->
    <form 
        id="addForm" 
        class="@if($outfits->count() == 0) show @endif"
        action="{{ route('outfit.create') }}" 
        method="POST" 
        enctype="multipart/form-data">
        @csrf
        <h3>Add New Outfit</h3>
        <input type="text" name="name" placeholder="Outfit Name" required>
        <textarea name="description" placeholder="Description"></textarea>

        <!-- Category -->
        <div class="form-row">
            <label>Category:</label><br>
            @foreach(['Fullset', 'Accessories', 'Top', 'Bottom'] as $type)
                <label>
                    <input type="radio" name="type" value="{{ strtolower($type) }}" required> {{ $type }}
                </label>
            @endforeach
        </div>

        <!-- Gender -->
        <div class="form-row">
            <label>Gender:</label><br>
            <label><input type="radio" name="gender" value="male" required> Male</label>
            <label><input type="radio" name="gender" value="female"> Female</label>
        </div>

        <!-- Status -->
        <div class="form-row">
            <label>Status:</label><br>
            <label><input type="radio" name="status" value="available" checked> Available</label>
            <label><input type="radio" name="status" value="not available"> Not Available</label>
        </div>

        <input type="file" name="image">
        <button type="submit">Add Outfit</button>
    </form>

    <hr>

    <h3>Outfit List</h3>
    @foreach($outfits as $outfit)
        <div class="outfit-card">
            <strong>{{ $outfit->name }}</strong><br>
            {{ $outfit->description }}<br>
            @if($outfit->image_path)
                <img src="{{ asset('storage/' . $outfit->image_path) }}" style="height: 80px; border-radius: 8px; margin-top: 10px;">
            @endif
            <span class="status-badge {{ $outfit->status === 'not available' ? 'not-available' : 'available' }}">
                {{ ucfirst($outfit->status ?? 'available') }}
            </span><br>
            <form action="{{ route('outfit.delete', $outfit->id) }}" method="POST" onsubmit="return confirm('Delete this outfit?');" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" style="color: red;">Delete</button>
            </form>
            <a href="{{ route('outfit.edit', $outfit->id) }}" class="edit-link">Edit</a>
        </div>
    @endforeach
</div>

<script>
    function toggleAddForm() {
        const form = document.getElementById('addForm');
        form.classList.toggle('show');
    }
</script>
@endsection
