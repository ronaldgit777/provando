<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSueldosecresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sueldosecres', function (Blueprint $table) {
            $table->engine="InnoDB";
            $table->bigIncrements('id');
            $table->date('fechadesueldo');
            $table->string('mesdepago');
            $table->integer('totaldescuento');
            $table->integer('totalpago');
            $table->string('observacion');
            $table->bigInteger('secretaria_id')->unsigned();
            $table->foreign('secretaria_id')->references('id')->on('secretarias')->onDelete('cascade');
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
        Schema::dropIfExists('sueldosecres');
    }
}
