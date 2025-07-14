<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OutfitBooking extends Model
{
    protected $fillable = [
        'outfit_id',
        'user_id',
        'name',
        'matric_no',
        'club',
        'purpose',
        'phone',
        'size',
        'booking_date',
        'return_date',
        'status',
    ];

    public function outfit()
    {
        return $this->belongsTo(Outfit::class, 'outfit_id');
    }
}

