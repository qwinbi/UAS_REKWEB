<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_amount',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Status options
    public function getStatusBadgeAttribute()
    {
        $statuses = [
            'pending' => 'secondary',
            'processing' => 'info',
            'completed' => 'success',
            'cancelled' => 'danger',
        ];

        $color = $statuses[$this->status] ?? 'secondary';
        return '<span class="badge bg-' . $color . '">' . ucfirst($this->status) . '</span>';
    }

    // Format order number
    public function getOrderNumberAttribute()
    {
        return 'ORD-' . str_pad($this->id, 6, '0', STR_PAD_LEFT);
    }
}