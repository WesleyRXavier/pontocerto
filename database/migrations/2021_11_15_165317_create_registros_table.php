<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registros', function (Blueprint $table) {
            $table->increments('id');
            $table->date('data');
            $table->dateTime('hora');
            $table->string('localizacao');
          
             //chave estrangeira tipo registro
            $table->integer('reg_id')->unsigned();
            $table->foreign('reg_id')->
             references('id')->
            on('tpregistros')->
            onDelete('cascade');
            //chave estrangeira usuarios
            $table->integer('user_id')->unsigned();
             $table->foreign('user_id')->
              references('id')->
             on('users')->
             onDelete('cascade');
            $table->timestampsTz();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registros');
    }
}
