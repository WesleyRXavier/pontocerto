<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */ //para usar a autenticacao do laravel mative os campos ccom o nome ingles e acrecentei outros
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('cpf',20);
            $table->integer('matricula');
            $table->string('cargo',20);
            $table->string('telefone',20);
            $table->integer('pin')->nullable();
            ///chave estrangeiras acesso
            $table->integer('acesso_id')->unsigned();
             $table->foreign('acesso_id')->
              references('id')->
             on('acessos')->
             onDelete('cascade'); 
            $table->string('email')->unique();
            $table->timestampTz('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
