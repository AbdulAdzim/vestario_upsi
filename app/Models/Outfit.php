<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Outfit extends Model
{
    protected $fillable = [
    'name',
    'description',
    'type',
    'gender',
    'status',
    'image_path',
    'is_featured',
    'available_sizes', // JSON array of available sizes
    ];

}
