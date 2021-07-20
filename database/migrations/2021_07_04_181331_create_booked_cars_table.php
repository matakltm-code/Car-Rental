<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookedCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booked_cars', function (Blueprint $table) {
            $table->id();
            $table->integer('car_id');
            $table->integer('user_id');
            $table->date('start_date');
            $table->date('end_date');
            // $table->string('trf')->unique(); // Bank transaction reference number
            $table->string('status')->default('pending'); // pending, approved, cancel
            $table->string('cancel_by')->nullable(); // customer, rentalofficer
            // $table->string('bank_book'); // customer, rentalofficer
            $table->string('trf')->unique();
            $table->decimal('total_price')->nullable(); // (start_date - end_date) * price/day
            $table->boolean('with_driver')->default(false);
            $table->text('payment_attached_file_path')->nullable();
            $table->integer('driver_id')->nullable(); // if user select with driver the the Rental officer will assign driver to this user
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booked_cars');
    }
}
