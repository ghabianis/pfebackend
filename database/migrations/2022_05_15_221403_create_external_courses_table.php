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
        Schema::create('external_courses', function (Blueprint $table) {
            $table->id();
            $table->string('userId');
            $table->string('email');
            $table->string('coursePrice');
            $table->string('desc');
            $table->date('start');
            $table->date('end');
            $table->boolean('accepted')->default(false);
            $table->boolean('rejected')->default(false);
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
        Schema::dropIfExists('external_courses');
    }
};
