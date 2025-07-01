<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudioBooking extends Model
{
    protected $fillable = [
        'name', 'matrics', 'club', 'reason', 'phone',
        'start_date', 'end_date', 'time_slot', 'studios'
    ];

    protected $casts = [
        'studios' => 'array',
    ];
}