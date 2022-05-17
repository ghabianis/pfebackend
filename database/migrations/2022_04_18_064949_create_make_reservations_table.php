<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('make_reservations', function (Blueprint $table) {
            $table->id();
            $table->string('userId');
            $table->string('email');
            $table->string('mouse');
            $table->string('desk');
            $table->string('screen');
            $table->date('start');
            $table->date('end');
            $table->boolean('accept')->default(false);
            $table->boolean('reject')->default(false);
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
        Schema::dropIfExists('make_reservations');
    }
};
