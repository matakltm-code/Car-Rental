<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookedCar extends Model
{
    use HasFactory;
    protected $guarded = [];


    // pending, approved, cancel
    public function car_status_text($status)
    {
        $result = '';
        if ($status == 'pending') {
            $result = '<b class="text-warning">Pending</b>';
        }
        if ($status == 'approved') {
            $result = '<b class="text-success">Approved</b>';
        }
        if ($status == 'cancel') {
            $result = '<b class="text-danger">Cancel</b>';
        }

        return $result;
    }

    // Canceld by text // customer, rentalofficer
    public function car_status_canceled_by_text($canceled_by)
    {
        $result = '';
        if ($canceled_by == 'customer') {
            $result = '<b class="text-danger">You canceled this reservation</b>';
        }
        if ($canceled_by == 'rentalofficer') {
            $result = '<b class="text-danger">Your reservation is canceled by our staff memeber(rental officer)</b>';
        }


        return $result;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id');
    }
}
