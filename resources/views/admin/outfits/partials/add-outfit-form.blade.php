<!-- ✅ Flash Message -->
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        ✅ {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- ✅ Add New Outfit Form -->
<form id="addOutfitForm" action="{{ route('outfit.create') }}" method="POST" enctype="multipart/form-data" style="margin-bottom: 30px;">

    @csrf
    <h3>Add New Outfit</h3>
    <input type="text" name="name" placeholder="Outfit Name" required>
    <textarea name="description" placeholder="Description"></textarea>

    <label>Category:</label>
    @foreach(['Fullset', 'Accessories', 'Top', 'Bottom'] as $type)
        <label><input type="radio" name="type" value="{{ strtolower($type) }}" required> {{ $type }}</label>
    @endforeach

    <label>Gender:</label>
    <label><input type="radio" name="gender" value="male" required> Male</label>
    <label><input type="radio" name="gender" value="female"> Female</label>

    <label>Status:</label>
    <label><input type="radio" name="status" value="available" checked> Available</label>
    <label><input type="radio" name="status" value="not available"> Not Available</label>

    <label>Available Sizes:</label>
    <div class="size-options">
        @foreach(['S', 'M', 'L', 'XL', 'XXL'] as $size)
            <label><input type="checkbox" name="available_sizes[]" value="{{ $size }}"> {{ $size }}</label>
        @endforeach
    </div>

    <div class="mt-3">
        <label>Upload Image:</label>
        <input type="file" name="image" class="form-control mb-3">
    </div>

    <div class="mt-4">
        <button type="submit" class="btn btn-primary w-100" style="font-weight: 600; padding: 10px 0;">
            Submit New Outfit
        </button>
    </div>

    <script>
    document.getElementById('addOutfitForm').addEventListener('submit', function (e) {
        const checkboxes = document.querySelectorAll('#addOutfitForm input[name="available_sizes[]"]');
        let checked = false;

        checkboxes.forEach(cb => {
            if (cb.checked) checked = true;
        });

        if (!checked) {
            e.preventDefault();
            alert("⚠️ Please select at least one available size.");
        }
    });
</script>
</form>