<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoftwareStoreItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_name',
        'category',
        'price',
        'description',
        'is_featured',
        'image_url',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'is_featured' => 'boolean',
        ];
    }

    public function purchases()
    {
        return $this->hasMany(SoftwareStorePurchase::class, 'item_id');
    }
}
