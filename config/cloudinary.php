<?php

return [
    'cloud' => [
        'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
        'api_key'    => env('CLOUDINARY_API_KEY'),
        'api_secret' => env('CLOUDINARY_API_SECRET'),
    ],
    'url' => env('CLOUDINARY_URL'),
    'upload_preset' => env('CLOUDINARY_UPLOAD_PRESET'),
];
