<!-- ✅ Flash Message -->
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        ✅ {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- ✅ Clean Add Outfit Form -->
<form id="addOutfitForm" action="{{ route('outfit.create') }}" method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded shadow-sm" style="max-width: 600px; margin: 0 auto 40px;">

    @csrf
    <h3 class="mb-4 text-center fw-bold">Add New Outfit</h3>

    <!-- Name -->
    <div class="mb-3">
        <label for="name" class="form-label">Outfit Name</label>
        <input type="text" name="name" class="form-control" placeholder="e.g. Baju Kurung Tradisional" required>
    </div>

    <!-- Description -->
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" rows="3" class="form-control" placeholder="Describe the outfit..."></textarea>
    </div>

    <!-- Category -->
    <div class="mb-3">
        <label class="form-label">Category</label>
        <div class="d-flex gap-3 flex-wrap">
            @foreach(['Fullset', 'Accessories', 'Top', 'Bottom'] as $type)
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="type" id="type_{{ $type }}" value="{{ strtolower($type) }}" required>
                    <label class="form-check-label" for="type_{{ $type }}">{{ $type }}</label>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Gender -->
    <div class="mb-3">
        <label class="form-label">Gender</label>
        <div class="d-flex gap-3">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="male" value="male" required>
                <label class="form-check-label" for="male">Male</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="female" value="female">
                <label class="form-check-label" for="female">Female</label>
            </div>
        </div>
    </div>

    <!-- Status -->
    <div class="mb-3">
        <label class="form-label">Availability Status</label>
        <div class="d-flex gap-3">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="available" value="available" checked>
                <label class="form-check-label" for="available">Available</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="not_available" value="not available">
                <label class="form-check-label" for="not_available">Not Available</label>
            </div>
        </div>
    </div>

    <!-- ✅ Available Sizes -->
<div class="mb-3" id="sizeSection">
    <label class="form-label">Available Sizes</label>
    <div class="d-flex gap-3 flex-wrap">
        @foreach(['S', 'M', 'L', 'XL', 'XXL'] as $size)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="available_sizes[]" id="size_{{ $size }}" value="{{ $size }}">
                <label class="form-check-label" for="size_{{ $size }}">{{ $size }}</label>
            </div>
        @endforeach
    </div>
</div>


    <!-- Image Upload -->
    <div class="mb-4">
        <label for="image" class="form-label">Upload Outfit Image</label>
        <input type="file" name="image" class="form-control" accept="image/*">
        <small class="text-muted">Max file size: 2MB. Accepted formats: JPG, JPEG, PNG, WEBP.</small>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary w-100 fw-semibold py-2">
        Submit New Outfit
    </button>
</form>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const typeRadios = document.querySelectorAll('input[name="type"]');
    const sizeSection = document.getElementById('sizeSection');

    function toggleSizeSection() {
        const selectedType = document.querySelector('input[name="type"]:checked');
        if (selectedType && selectedType.value === 'accessories') {
            sizeSection.style.display = 'none';
        } else {
            sizeSection.style.display = '';
        }
    }

    // Run on load
    toggleSizeSection();

    // Listen for changes
    typeRadios.forEach(radio => {
        radio.addEventListener('change', toggleSizeSection);
    });
});
</script>
