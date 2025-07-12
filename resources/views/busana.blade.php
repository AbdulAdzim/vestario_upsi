<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Outfit Booking</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .outfit-card { border: 1px solid #ccc; padding: 15px; margin-bottom: 15px; border-radius: 8px; }
        .outfit-title { font-weight: bold; }
        .form-row { margin-top: 10px; }
        input, select, textarea { width: 100%; padding: 8px; margin: 5px 0; }
    </style>
</head>
<body>

    <a href="{{ route('dashboard') }}" style="
        display: inline-block;
        margin-bottom: 20px;
        padding: 10px 15px;
        background-color: #f0f0f0;
        color: #333;
        text-decoration: none;
        border-radius: 6px;
        border: 1px solid #ccc;
        font-weight: bold;
    ">
        ← Back to Dashboard
    </a>

    <h2>🧥 Book Your Outfit</h2>

    <!-- ✅ Admin-only: Add Outfit Form -->
    @auth
        @if(auth()->user()->role === 'admin')
            <form action="{{ route('outfit.create') }}" method="POST" enctype="multipart/form-data" style="margin-bottom: 30px;">
                @csrf
                <h3>Add New Outfit</h3>
                <input type="text" name="name" placeholder="Outfit Name" required>
                <textarea name="description" placeholder="Description"></textarea>
                <input type="file" name="image">
                <button type="submit">Add Outfit</button>
            </form>
            <hr>
        @endif
    @endauth

    <!-- 🎞️ Featured Outfits Slider -->
    <div class="swiper mySwiper" style="height: 300px; margin-bottom: 30px;">
        <div class="swiper-wrapper">
            @foreach($featuredOutfits as $outfit)
                <div class="swiper-slide">
                    <img src="{{ asset('storage/' . $outfit->image_path) }}" alt="{{ $outfit->name }}" style="height: 100%; object-fit: cover; border-radius: 10px;">
                </div>
            @endforeach
        </div>
    </div>

    <!-- 👤 Applicant Form for Users Only -->
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
                            <div style="margin: 10px 0;">
                                <img src="{{ asset('storage/' . $outfit->image_path) }}" alt="Preview" style="height: 120px; border-radius: 8px;">
                            </div>
                        @endif

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
                    </div>
                @endforeach

                <button type="submit">📩 Submit Booking</button>
            </form>
        @endif
    @endauth

    <!-- 🗑️ Admin-only: Delete Buttons on each Outfit -->
    @auth
        @if(auth()->user()->role === 'admin')
            <h3>🗑️ Delete Existing Outfits</h3>
            @foreach($outfits as $outfit)
                <div class="outfit-card">
                    <strong>{{ $outfit->name }}</strong><br>
                    {{ $outfit->description }}<br>
                    @if($outfit->image_path)
                        <img src="{{ asset('storage/' . $outfit->image_path) }}" style="height: 80px; border-radius: 8px; margin-top: 10px;">
                    @endif
                    <form action="{{ route('outfit.delete', $outfit->id) }}" method="POST" onsubmit="return confirm('Delete this outfit?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="color: red;">Delete</button>
                    </form>
                    <!-- Edit Link for Admins -->

                    <a href="{{ route('outfit.edit', $outfit->id) }}" style="margin-left: 10px; color: blue;">Edit</a>

                </div>
            @endforeach
        @endif
    @endauth

    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script>
        new Swiper('.mySwiper', {
            loop: true,
            autoplay: { delay: 3000 },
            slidesPerView: 1,
        });
    </script>
</body>
</html>
