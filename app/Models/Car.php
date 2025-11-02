<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'brand',
        'model',
        'year',
        'color',
        'transmission',
        'fuel_type',
        'mileage',
        'price',
        'license_plate',
        'engine_capacity',
        'passengers',
        'description',
        'features',
        'condition',
        'status',
        'main_image',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'year' => 'integer',
        'mileage' => 'integer',
        'engine_capacity' => 'integer',
        'passengers' => 'integer',
    ];

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(CarImage::class)->orderBy('order');
    }

    public function testDrives()
    {
        return $this->hasMany(TestDrive::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Scopes
    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    // Helper methods
    public function getFullNameAttribute()
    {
        return "{$this->brand} {$this->model} ({$this->year})";
    }

    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }
}
