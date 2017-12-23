<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image')->default('fotoperfil.jpg');
            $table->string('phone')->default('Ingrese un numero telefonico');
            $table->string('address')->default('Ingrese una direccion');
            $table->string('description',200)->default('Descripcion breve de la empresa');
            $table->integer('commune_id')->nullable()->unsigned();
            $table->integer('user_id')->unsigned()->unique();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('commune_id')->references('id')->on('communes')->onUpdate('cascade');
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
        Schema::dropIfExists('companies');
    }
}
// 