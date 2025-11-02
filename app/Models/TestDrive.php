<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TestDrive extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'car_id',
        'test_drive_date',
        'test_drive_time',
        'location',
        'notes',
        'status',
        'admin_notes',
    ];

    protected $casts = [
        'test_drive_date' => 'date',
        'test_drive_time' => 'datetime:H:i',
    ];

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
}
