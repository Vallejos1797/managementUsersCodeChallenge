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
        Schema::create('custom_users', function (Blueprint $table) {
            $table->id();
            $table->string('user');
            $table->string('firstName');
            $table->string('secondName')->nullable();
            $table->string('lastName');
            $table->string('secondLastname')->nullable();
            $table->string('idDeparture')->nullable();
            $table->string('idBusinessPosition')->nullable();
            $table->timestamps();
            $table->softDeletes(); // Agregamos la columna 'deleted_at' para SoftDeletes
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('custom_users');
    }
};
