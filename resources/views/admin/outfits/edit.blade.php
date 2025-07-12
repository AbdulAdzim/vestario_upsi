<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Outfit</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        input, textarea { width: 100%; padding: 8px; margin-top: 5px; margin-bottom: 15px; }
        button { padding: 10px 20px; background-color: #4CAF50; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #45a049; }
    </style>
</head>
<body>
    <h2>✏️ Edit Outfit</h2>

    <form action="{{ route('outfit.update', $outfit->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label>Name:</label>
        <input type="text" name="name" value="{{ $outfit->name }}" required>

        <label>Description:</label>
        <textarea name="description">{{ $outfit->description }}</textarea>

        <label>Status (e.g. Out of Stock):</label>
        <input type="text" name="status" value="{{ $outfit->status }}">

        @if($outfit->image_path)
            <p>Current Image:</p>
            <img src="{{ asset('storage/' . $outfit->image_path) }}" style="height: 120px; border-radius: 8px;">
        @endif

        <label>Replace Image:</label>
        <input type="file" name="image">

        <br><br>
        <button type="submit">💾 Update Outfit</button>
    </form>

    <br><a href="{{ route('busana') }}">← Back to Outfit Page</a>
</body>
</html>
