<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGarantiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('garantias', function (Blueprint $table) {
            $table->id();
            $table->string('dni', 10)->nullable();
            $table->string('nombre', 256)->nullable();
            $table->string('celular', 25)->nullable();
            $table->datetime('fecha_ingreso');
            $table->string('problema', 256)->nullable();
            $table->string('documento', 256)->nullable();
            $table->string('observacion', 256)->nullable();

            $table->unsignedBigInteger('tecnico_id')->nullable();
            $table->foreign('tecnico_id')->references('id')->on('users');

            $table->boolean('salio')->default(0);
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
        Schema::dropIfExists('garantias');
    }
}
