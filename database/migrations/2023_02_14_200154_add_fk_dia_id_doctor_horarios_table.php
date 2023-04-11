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
        Schema::table('doctor_horarios', function (Blueprint $table) {
            $table->after('id', function ($table) {
                $table->foreignId('dia_id')->constrained('dias')->onUpdate('cascade')->onDelete('cascade');
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('doctor_horarios', function (Blueprint $table) {
            $table->dropForeign('doctor_horarios_dia_id_foreign');
            $table->dropColumn('dia_id');
        });
    }
};
