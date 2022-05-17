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
        Schema::create('user_profile_infos', function (Blueprint $table) {
            $table->id();
            $table->string('userId');
            $table->string('nationality');
            $table->string('childnb');
            $table->string('adress');
            $table->string('email');
            $table->string('favcol');
            $table->string('fcblink');
            $table->string('instlink');
            $table->string('linkdlink');
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('user_profile_infos');
    }
};
