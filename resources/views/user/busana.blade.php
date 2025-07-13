@extends('layouts.app')

@section('title', 'Busana Booking')

@section('content')
<div class="container mt-5">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <h2 class="mb-4">Busana Booking</h2>

    @auth
        @if(auth()->user()->role !== 'admin')
            <form action="{{ route('busana.confirm') }}" method="POST">
    @csrf

                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Matric / Staff No</label>
                    <input type="text" name="matric_no" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Club / Association</label>
                    <input type="text" name="club" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Purpose</label>
                    <textarea name="purpose" class="form-control" required></textarea>
                </div>
                <div class="mb-3">
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control" required>
                </div>

                <hr>

                <h4>Available Outfits</h4>

                <!-- 🔍 Filter Controls -->
                <div class="mb-4">
                    <h5>Filter by Type:</h5>
                    <div class="btn-group mb-2">
                        @foreach(['all', 'fullset', 'accessories', 'top', 'bottom'] as $type)
                            <a href="?type={{ $type }}{{ request('gender') ? '&gender=' . request('gender') : '' }}"
                            class="btn btn-outline-primary {{ request('type', 'all') === $type ? 'active' : '' }}">
                            {{ ucfirst($type) }}
                            </a>
                        @endforeach
                    </div>

                    <h5>Filter by Gender:</h5>
                    <div class="btn-group">
                        @foreach(['all', 'male', 'female'] as $gender)
                            <a href="?gender={{ $gender }}{{ request('type') ? '&type=' . request('type') : '' }}"
                            class="btn btn-outline-secondary {{ request('gender', 'all') === $gender ? 'active' : '' }}">
                            {{ ucfirst($gender) }}
                            </a>
                        @endforeach
                    </div>
                </div>


                <div class="row">
                    @foreach($outfits as $outfit)
                        @if($outfit->status === 'available')
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    <img src="{{ asset('storage/' . $outfit->image_path) }}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $outfit->name }}</h5>
                                        <p class="card-text">{{ $outfit->description }}</p>

                                        <label>Size</label>
                                        <select name="sizes[{{ $outfit->id }}]" class="form-control mb-2">
                                            <option value="">-- Select Size --</option>
                                            @foreach(json_decode($outfit->available_sizes ?? '[]') as $size)
                                                <option value="{{ $size }}">{{ $size }}</option>
                                            @endforeach
                                        </select>

                                        <label>Booking Date</label>
                                        <input type="date" name="dates[{{ $outfit->id }}]" class="form-control mb-2">

                                        <label>Return Date</label>
                                        <input type="date" name="returns[{{ $outfit->id }}]" class="form-control">
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <button type="submit" class="btn btn-primary mt-3">Submit Booking</button>
            </form>
            <script>
    function showConfirmation(event) {
        event.preventDefault();

        const form = document.getElementById('bookingForm');
        const formData = new FormData(form);

        const outfits = @json($outfits);
        let hasSelection = false;

        let summary = `
            <strong>👤 User Information</strong><ul>
                <li><b>Name:</b> ${formData.get('name')}</li>
                <li><b>Matric/Staff No:</b> ${formData.get('matric_no')}</li>
                <li><b>Club/Association:</b> ${formData.get('club')}</li>
                <li><b>Purpose:</b> ${formData.get('purpose')}</li>
                <li><b>Phone:</b> ${formData.get('phone')}</li>
            </ul>
            <strong>🎽 Outfit Selections</strong><ul>
        `;

        outfits.forEach(outfit => {
            const size = formData.get(`sizes[${outfit.id}]`);
            const date = formData.get(`dates[${outfit.id}]`);
            const ret = formData.get(`returns[${outfit.id}]`);

            if (size && date && ret) {
                hasSelection = true;
                summary += `<li><b>${outfit.name}</b><ul>
                                <li>Size: ${size}</li>
                                <li>Booking Date: ${date}</li>
                                <li>Return Date: ${ret}</li>
                            </ul></li>`;
            }
        });

        summary += '</ul>';

        if (!hasSelection) {
            alert("⚠️ Please select at least one available size, booking date, and return date.");
            return false;
        }

        document.getElementById('confirmationDetails').innerHTML = summary;
        form.style.display = 'none';
        document.getElementById('confirmationSection').style.display = 'block';
        return false;
    }

    function submitFinalBooking() {
        document.getElementById('bookingForm').submit();
    }

    function goBackToForm() {
        document.getElementById('confirmationSection').style.display = 'none';
        document.getElementById('bookingForm').style.display = 'block';
    }
</script>

        @endif
    @endauth
</div>
@endsection
