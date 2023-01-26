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
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->string('cedula', 10)->unique();
            $table->string('nombre', 50);
            $table->string('apellido', 50);
            $table->string('celular', 10)->nullable();
            $table->string('telefono', 10)->nullable();
            $table->text('direccion')->nullable();
            $table->char('estado')->default('A');
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
        Schema::dropIfExists('personas');
    }
};
