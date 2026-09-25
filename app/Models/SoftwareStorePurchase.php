<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoftwareStorePurchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item_id',
        'purchase_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function item()
    {
        return $this->belongsTo(SoftwareStoreItem::class, 'item_id');
    }
}
