<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepairPricing extends Model
{
    use HasFactory;

    protected $table = 'repair_pricings';

    protected $fillable = [
        'service_id',
        'device_type',
        'price',
        'price_label',
        'notes',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    public function service()
    {
        return $this->belongsTo(RepairService::class, 'service_id');
    }
}
