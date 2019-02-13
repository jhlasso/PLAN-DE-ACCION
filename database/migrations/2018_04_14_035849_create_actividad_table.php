<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActividadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividad', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',50);
            $table->string('estado',15);
            $table->string('indicador');
            $table->string('tipo',10);
            $table->integer('presupuesto');
            $table->integer('objetivo_id')->unsigned();
            $table->timestamps();

            $table->foreign('objetivo_id')->references('id')->on('objetivo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actividad');
    }
}
