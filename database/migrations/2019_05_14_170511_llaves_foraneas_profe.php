<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LlavesForaneasProfe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('evaluacion', function (Blueprint $table) {
            $table->unsignedInteger('id_profesor');
            $table->foreign('id_profesor')->references('id')->on('profesor');
        });

        Schema::table('comentario', function (Blueprint $table) {
            $table->unsignedInteger('id_profesor');
            $table->foreign('id_profesor')->references('id')->on('profesor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
