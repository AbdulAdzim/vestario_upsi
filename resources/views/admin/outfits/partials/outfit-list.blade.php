{{-- resources/views/admin/outfits/partials/outfit-list.blade.php --}}
<h3>Outfit List</h3>
<div class="outfit-grid">
    @foreach($outfits as $outfit)
        <div class="outfit-card p-3 border mb-3 rounded shadow-sm">
            <strong class="d-block mb-1 fs-5">{{ $outfit->name }}</strong>
            <div class="mb-1"><strong>Description:</strong> {{ $outfit->description }}</div>
            <div class="mb-1"><strong>Category:</strong> {{ $outfit->type ?? 'N/A' }}</div>
            <div class="mb-1"><strong>Gender:</strong> {{ ucfirst($outfit->gender ?? 'Unisex') }}</div>
            <div class="mb-2"><strong>Available Sizes:</strong> {{ $outfit->available_sizes ?? 'Free Size' }}</div>

            @if ($outfit->image_path)
                <img src="{{ asset('storage/' . $outfit->image_path) }}"
                     alt="Outfit Image"
                     style="max-height: 150px; width: auto; margin-top: 10px;">
            @else
                <p style="color: gray;">No image uploaded</p>
            @endif

            <div class="mt-2">
                <span class="badge {{ $outfit->status === 'not available' ? 'bg-danger' : 'bg-success' }}">
                    {{ ucfirst($outfit->status ?? 'available') }}
                </span>
            </div>

            <div class="mt-2">
                <form action="{{ route('outfit.delete', $outfit->id) }}" method="POST" onsubmit="return confirm('Delete this outfit?');" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                </form>
                <a href="{{ route('outfit.edit', $outfit->id) }}" class="btn btn-sm btn-outline-primary ms-2">Edit</a>
            </div>
        </div>
    @endforeach
</div>
