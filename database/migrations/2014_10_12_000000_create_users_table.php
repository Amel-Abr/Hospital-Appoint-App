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
            $table->string('fullname');
            $table->string('department')->nullable();
            $table->integer('phone')->nullable();
            $table->boolean('isAdmin')->default(false);
            // $table->date('startDay')->nullable();
            // $table->date('lastDay')->nullable();
            // $table->time('startTime')->nullable();
            // $table->time('endTime')->nullable();
            // $table->time('duration')->nullable();
            // $table->foreignId('hospitalID')
            //       ->constrained('hospital')
            //       ->onDelete('cascade')
            //       ->onUpdate('cascade');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
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
