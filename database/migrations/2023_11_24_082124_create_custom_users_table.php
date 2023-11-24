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
            $table->string('username');
            $table->string('email');
            $table->string('firstName');
            $table->string('secondName')->nullable();
            $table->string('lastName');
            $table->string('secondLastName')->nullable();
            $table->unsignedBigInteger('departmentId')->nullable();
            $table->unsignedBigInteger('positionId')->nullable();
            $table->timestamps();
            $table->softDeletes(); // Elimina esta línea


            // Foreign keys
            $table->foreign('departmentId')->references('id')->on('departments');
            $table->foreign('positionId')->references('id')->on('positions');
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
