<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    // Table
    protected $table = 'users';
    // Primary Key
    protected $primaryKey = 'id';
    // created_at and updated_at
    public $timestamps = true;


    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        // 'date_of_birth' => 'datetime',
    ];

    /**
     * $user = User::find(1);
     * $user->is_admin; // true or false
     * $user->is_manager; // true or false
     * $user->is_rentalofficer; // true or false
     * $user->is_driver; // true or false
     * $user->is_customer; // true or false
     */
    // UserTypes in user_type column: admin, manager, rentalofficer, driver, customer
    public function getIsAdminAttribute()
    {
        return auth()->user()->user_type == 'admin';
    }
    public function getIsManagerAttribute()
    {
        return auth()->user()->user_type == 'manager';
    }
    public function getIsRentalofficerAttribute()
    {
        return auth()->user()->user_type == 'rentalofficer';
    }
    public function getIsDriverAttribute()
    {
        return auth()->user()->user_type == 'driver';
    }
    public function getIsCustomerAttribute()
    {
        return auth()->user()->user_type == 'customer';
    }




    public function account_type_text($user_type)
    {
        $result = '';
        if ($user_type == 'admin') {
            $result = 'Adminstrator';
        }
        if ($user_type == 'manager') {
            $result = 'Manager';
        }
        if ($user_type == 'rentalofficer') {
            $result = 'Rental Officer';
        }
        if ($user_type == 'driver') {
            $result = 'Driver';
        }
        if ($user_type == 'customer') {
            $result = 'Customer';
        }

        return $result;
    }
}
