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
        Schema::create('reclamations', function (Blueprint $table) {
            $table->id();
            $table->string('userId');
            $table->string('prenom');
            $table->string('nom');
            $table->string('email');
            $table->string('departement');
            $table->string('chef');
            $table->string('cause');
            $table->date('start')->toDateString();
            $table->date('end')->toDateString();
            $table->boolean('status')->default(false);
            $table->boolean('reject')->default(false);
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
        Schema::dropIfExists('reclamations');
    }
};
