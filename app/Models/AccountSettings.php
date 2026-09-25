<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountSettings extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'theme',
        'email_notifications',
        'sms_notifications',
        'booking_reminders',
        'auto_login',
        'timezone',
    ];

    protected function casts(): array
    {
        return [
            'email_notifications' => 'boolean',
            'sms_notifications' => 'boolean',
            'booking_reminders' => 'boolean',
            'auto_login' => 'boolean',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
