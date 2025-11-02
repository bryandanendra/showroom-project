<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'car_id',
        'price',
        'down_payment',
        'payment_method',
        'id_card_path',
        'driver_license_path',
        'credit_approval_path',
        'customer_notes',
        'status',
        'admin_notes',
        'approved_at',
        'completed_at',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'down_payment' => 'decimal:2',
        'approved_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    // Boot method to auto-generate order number
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            if (empty($order->order_number)) {
                $order->order_number = 'ORD-' . strtoupper(Str::random(10));
            }
        });
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    // Helper methods
    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    public function getFormattedDownPaymentAttribute()
    {
        return 'Rp ' . number_format($this->down_payment, 0, ',', '.');
    }

    public function getFormattedTotalPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }
}
