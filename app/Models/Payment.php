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

    // Status options
    public function getStatusBadgeAttribute()
    {
        $statuses = [
            'pending' => 'warning',
            'approved' => 'success',
            'rejected' => 'danger',
        ];

        $color = $statuses[$this->status] ?? 'secondary';
        return '<span class="badge bg-' . $color . '">' . ucfirst($this->status) . '</span>';
    }

    // Payment method display
    public function getMethodDisplayAttribute()
    {
        $methods = [
            'virtual_account' => 'Virtual Account',
            'qris' => 'QRIS',
        ];

        return $methods[$this->method] ?? $this->method;
    }
}