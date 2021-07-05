<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('plate_number');
            $table->decimal('price_with_driver', $precision = 8, $scale = 2);
            $table->decimal('price_with_out_driver', $precision = 8, $scale = 2);
            $table->string('model');
            $table->integer('seat_capacity');
            $table->text('car_status');

            $table->text('image_url');
            $table->boolean('activated')->default(true);

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
        Schema::dropIfExists('cars');
    }
}
