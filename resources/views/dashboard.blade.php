<x-layouts.app :title="__('Dashboard')">
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vestario</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      background-color: #f0f4f8;
      color: #333;
    }

    header {
      text-align: center;
      padding: 40px 20px 20px;
    }

    header h1 {
      font-size: 48px;
      color: #222;
    }

    .hero-image {
      display: flex;
      justify-content: center;
      padding: 20px;
    }

    .hero-image img {
      max-width: 90%;
      height: auto;
      border-radius: 20px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .search-container {
      display: flex;
      justify-content: center;
      margin: 30px;
    }

    .search-container input[type="text"] {
      width: 60%;
      padding: 14px 20px;
      font-size: 18px;
      border-radius: 25px;
      border: 1px solid #ccc;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    .gallery {
      display: flex;
      overflow-x: auto;
      scroll-snap-type: x mandatory;
      gap: 20px;
      padding: 20px;
      margin: 0 20px;
    }

    .gallery img {
      width: 300px;
      height: 400px;
      object-fit: cover;
      border-radius: 12px;
      scroll-snap-align: center;
      flex-shrink: 0;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    @media (max-width: 768px) {
      header h1 {
        font-size: 36px;
      }

      .search-container input[type="text"] {
        width: 90%;
      }

      .gallery img {
        width: 240px;
        height: 320px;
      }
    }
  </style>
</head>
<body>
  <header>
    <h1>Vestario</h1>
  </header>

  <div class="hero-image">
    <img src="/mnt/data/c5d8ead2-0759-4e46-b64a-20d5cac13a17.png" alt="Clothing Page Image">
  </div>

  <div class="search-container">
    <input type="text" placeholder="Search for fashion, styles, or brands...">
  </div>

  <div class="gallery">
    <img src="https://source.unsplash.com/300x400/?fashion1" alt="Fashion 1">
    <img src="https://source.unsplash.com/300x400/?fashion2" alt="Fashion 2">
    <img src="https://source.unsplash.com/300x400/?fashion3" alt="Fashion 3">
    <img src="https://source.unsplash.com/300x400/?fashion4" alt="Fashion 4">
    <img src="https://source.unsplash.com/300x400/?fashion5" alt="Fashion 5">
  </div>
</body>
</html>

</x-layouts.app>
