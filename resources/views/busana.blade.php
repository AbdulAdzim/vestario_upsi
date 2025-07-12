@extends('layouts.app')

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

    .form-row {
        margin-top: 12px;
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

    button,
    .btn-outline-primary,
    .btn-outline-secondary {
        padding: 8px 16px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        font-weight: 600;
        margin-top: 15px;
    }

    button[type="submit"] {
        background-color: #007bff;
        color: white;
        border: none;
        transition: background-color 0.2s;
    }

    button[type="submit"]:hover {
        background-color: #0056b3;
    }

    .btn-group a {
        padding: 6px 12px;
        border: 1px solid #007bff;
        margin-right: 8px;
        border-radius: 6px;
        color: #007bff;
        text-decoration: none;
        transition: 0.2s;
    }

    .btn-group a:hover,
    .btn-group a.active {
        background-color: #007bff;
        color: #fff;
    }

    img {
        max-width: 100%;
        border-radius: 10px;
        margin: 10px 0;
    }

    hr {
        margin-top: 40px;
        margin-bottom: 30px;
    }

    h3 {
        margin-top: 30px;
        font-weight: 600;
        color: #333;
    }
</style>


<div class="container mt-5">
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold">Busana</h1>
        <p class="text-muted">Book your clothing now</p>
    </div>

    <!-- ✅ Admin Add Form -->
    @auth
        @if(auth()->user()->role === 'admin')
            <form action="{{ route('outfit.create') }}" method="POST" enctype="multipart/form-data" style="margin-bottom: 30px;">
                @csrf
                <h3>Add New Outfit</h3>
                <input type="text" name="name" placeholder="Outfit Name" required>
                <textarea name="description" placeholder="Description"></textarea>

                <div class="form-row">
                    <label>Category:</label><br>
                    @foreach(['Fullset', 'Accessories', 'Top', 'Bottom'] as $type)
                        <label><input type="radio" name="type" value="{{ strtolower($type) }}"> {{ $type }}</label>
                    @endforeach
                </div>

                <div class="form-row">
                    <label>Gender:</label><br>
                    <label><input type="radio" name="gender" value="male"> Male</label>
                    <label><input type="radio" name="gender" value="female"> Female</label>
                </div>

                <div class="form-row">
                    <label>Status:</label><br>
                    <label><input type="radio" name="status" value="available" checked> Available</label>
                    <label><input type="radio" name="status" value="not available"> Not Available</label>
                </div>

                <input type="file" name="image">
                <button type="submit">Add Outfit</button>
            </form>
            <hr>
        @endif
    @endauth

    @auth
    @if(auth()->user()->role !== 'admin')
        <!-- 🎞️ Featured Outfits -->
        <div class="swiper mySwiper" style="height: 300px; margin-bottom: 30px;">
            <div class="swiper-wrapper">
                @foreach($featuredOutfits as $outfit)
                    <div class="swiper-slide">
                        <img src="{{ asset('storage/' . $outfit->image_path) }}" alt="{{ $outfit->name }}" style="height: 100%; object-fit: cover; border-radius: 10px;">
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endauth


    <!-- 🧭 Filters -->
    <div class="mb-3">
        <h5>Filter by Type:</h5>
        <div class="btn-group mb-2">
            @foreach(['all', 'fullset', 'accessories', 'top', 'bottom'] as $type)
                <a href="?type={{ $type }}" class="btn btn-outline-primary">{{ ucfirst($type) }}</a>
            @endforeach
        </div>

        <h5>Filter by Gender:</h5>
        <div class="btn-group mb-4">
            @foreach(['all', 'male', 'female'] as $gender)
                <a href="?gender={{ $gender }}" class="btn btn-outline-secondary">{{ ucfirst($gender) }}</a>
            @endforeach
        </div>
    </div>

    <!-- 📝 User Booking Form -->
    @auth
        @if(auth()->user()->role !== 'admin')
            <form action="{{ route('busana.book') }}" method="POST">
                @csrf
                <h3>📌 Applicant Information</h3>
                <label>Full Name:</label>
                <input type="text" name="name" required>
                <label>Matric / Staff Number:</label>
                <input type="text" name="matric_no" required>
                <label>Club / Association:</label>
                <input type="text" name="club" required>
                <label>Purpose of Application:</label>
                <textarea name="purpose" required></textarea>
                <label>Phone Number:</label>
                <input type="text" name="phone" required>
                <label>Return Date:</label>
                <input type="date" name="return_date" required>

                <hr>
                <h3>🎽 Select Outfit(s)</h3>

                @foreach($outfits as $outfit)
                    <div class="outfit-card">
                        <div class="outfit-title">{{ $outfit->name }}</div>
                        <div>{{ $outfit->description }}</div>

                        @if($outfit->image_path)
                            <img src="{{ asset('storage/' . $outfit->image_path) }}" alt="Preview" style="height: 120px; border-radius: 8px; margin: 10px 0;">
                        @endif

                        <span class="status-badge {{ $outfit->status === 'not available' ? 'not-available' : 'available' }}">
                            {{ ucfirst($outfit->status ?? 'available') }}
                        </span>

                        @if($outfit->status !== 'not available')
                            <div class="form-row">
                                <label>Pick Size:</label>
                                <select name="sizes[{{ $outfit->id }}]">
                                    <option value="">-- Select --</option>
                                    @foreach(['S', 'M', 'L', 'XL', 'XXL'] as $size)
                                        <option value="{{ $size }}">{{ $size }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-row">
                                <label>Booking Date:</label>
                                <input type="date" name="dates[{{ $outfit->id }}]"
                                    min="{{ \Carbon\Carbon::today()->addDays(3)->toDateString() }}"
                                    max="{{ \Carbon\Carbon::today()->addDays(14)->toDateString() }}">
                            </div>
                        @else
                            <div class="form-row text-danger fw-bold">❌ Not available for booking.</div>
                        @endif
                    </div>
                @endforeach

                <button type="submit">📩 Submit Booking</button>
            </form>
        @endif
    @endauth

    <!-- 🛠️ Admin Manage Outfits -->
    @auth
        @if(auth()->user()->role === 'admin')
            <h3>🛠️ Manage Outfits</h3>
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
                    <a href="{{ route('outfit.edit', $outfit->id) }}" style="margin-left: 10px; color: blue;">Edit</a>
                </div>
            @endforeach
        @endif
    @endauth
</div>

<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script>
    new Swiper('.mySwiper', {
        loop: true,
        autoplay: { delay: 3000 },
        slidesPerView: 1,
    });
</script>
@endsection
