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
            if (auth()->user()->user_type === 'customer') {
                $result = '<b class="text-danger">You canceled this reservation</b>';
            } else {
                $result = '<b class="text-danger">Cancel this reservation by owner</b>';
            }
        }
        if ($canceled_by == 'rentalofficer') {
            if (auth()->user()->user_type === 'customer') {
                $result = '<b class="text-danger">Your reservation is canceled by our staff memeber(rental officer)</b>';
            } else {
                $result = '<b class="text-danger">You cancel this reservation(rental officer)</b>';
            }
        }


        return $result;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id');
    }

    /**
     * Get the driver that owns the BookedCar
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id', 'id');
    }
}
