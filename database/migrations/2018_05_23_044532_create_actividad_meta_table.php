<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActividadMetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividad_meta', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('actividad_id')->unsigned();
            $table->integer('meta_id')->unsigned();
            $table->timestamps();

            $table->foreign('actividad_id')->references('id')->on('actividad');
            $table->foreign('meta_id')->references('id')->on('meta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actividad_meta');
    }
}
