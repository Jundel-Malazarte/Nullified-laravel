<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'file_name',
        'file_path',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
