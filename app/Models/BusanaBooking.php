<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusanaBooking extends Model
{
    use HasFactory;

    // Optionally specify the table name if it's not the default
    protected $table = 'outfit_bookings';
}