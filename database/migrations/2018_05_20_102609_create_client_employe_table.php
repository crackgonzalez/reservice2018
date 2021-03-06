<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientEmployeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_employe', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned();
            $table->integer('employe_id')->unsigned();
            $table->integer('reservation_id')->unsigned();
            $table->unique(['client_id','employe_id','reservation_id']);
            $table->integer('score');
            $table->string('comment')->nullable();
            $table->foreign('client_id')->references('id')->on('clients')->onUpdate('cascade');
            $table->foreign('employe_id')->references('id')->on('employes')->onUpdate('cascade');
            $table->foreign('reservation_id')->references('id')->on('reservations')->onUpdate('cascade');
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
        Schema::dropIfExists('client_employe');
    }
}
