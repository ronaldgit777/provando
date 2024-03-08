<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFechadeasignacionToAsignarpromasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('asignarpromas', function (Blueprint $table) {
            $table->date('fechadeasignacion')->nullable()->after('id');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('asignarpromas', function (Blueprint $table) {
            $table->dropColumn('fechadeasignacion');
        });
    }
}
