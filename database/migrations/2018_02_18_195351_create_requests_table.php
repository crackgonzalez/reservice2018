<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned();
            $table->integer('company_id')->unsigned();
            $table->integer('service_id')->unsigned();
            $table->date('date');
            $table->string('image')->nullable();
            $table->string('state_company')->default('Esperando Confirmacion');
            $table->string('state_client')->default('Esperando Confirmacion');
            $table->unique(['client_id','company_id','service_id','date']);
            $table->foreign('client_id')->references('id')->on('clients')->onUpdate('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onUpdate('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onUpdate('cascade');
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
        Schema::dropIfExists('requests');
    }
}
