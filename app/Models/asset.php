<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'assets_key',
        'assets_type',
        'zero_code',
        'start_depreciation',
        'address',
        'qty',
        'unit',
        'age',
        'cost_price',
        'total_price',
        'layout',
        // 'user_id',
    ];
}
