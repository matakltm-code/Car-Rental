<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    // Table
    protected $table = 'cars';
    // Primary Key
    protected $primaryKey = 'id';
    // created_at and updated_at
    public $timestamps = true;

    protected $guarded = [];

    public function booked_cars()
    {
        return $this->hasMany(BookedCar::class, 'car_id', 'id');
    }
}
