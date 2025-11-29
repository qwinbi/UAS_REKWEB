<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'method',
        'proof_image',
        'status',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}