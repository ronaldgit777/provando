<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSueldoprosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sueldopros', function (Blueprint $table) {
            $table->engine="InnoDB";
            $table->bigIncrements('id');
            $table->date('fechadesueldo');
            $table->string('mesdepago');
            $table->integer('sueldo');
            $table->integer('totaldescuento');
            $table->integer('totalpago');
            $table->string('observacion');
            $table->bigInteger('profesor_id')->unsigned();
            $table->foreign('profesor_id')->references('id')->on('profesors')->onDelete('cascade');
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
        Schema::dropIfExists('sueldopros');
    }
}
