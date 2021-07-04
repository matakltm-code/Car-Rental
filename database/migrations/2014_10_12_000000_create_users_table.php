<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('address');
            $table->timestamp('date_of_birth');
            $table->text('driver_license_file_path')->nullable();

            $table->string('user_type')->default('student'); // admin, manager, rentalofficer, driver, customer
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->boolean('active_account')->default(true);
            $table->timestamp('last_login_at')->nullable(); // C:\xampp\htdocs\uog-thesis-projects\car-rental\vendor\laravel\ui\auth-backend\AuthenticatesUsers.php

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
