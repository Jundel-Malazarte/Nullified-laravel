<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service_id',
        'device_name',
        'device_brand',
        'device_model',
        'issue_description',
        'preferred_date',
        'preferred_time',
        'status',
        'priority',
        'admin_notes',
    ];

    protected function casts(): array
    {
        return [
            'preferred_date' => 'date',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(RepairService::class, 'service_id');
    }

    public function attachments()
    {
        return $this->hasMany(BookingAttachment::class);
    }
}
