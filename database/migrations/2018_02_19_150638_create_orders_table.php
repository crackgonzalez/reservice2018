<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned();
            $table->integer('company_id')->unsigned();
            $table->integer('service_id')->unsigned();
            $table->integer('commune_id')->unsigned();
            $table->integer('section_id')->unsigned();
            $table->date('date');
            $table->string('image')->nullable();
            $table->string('description',200);
            $table->string('answer',200)->nullable();
            $table->boolean('state_company')->default(false);
            $table->boolean('state_client')->default(false);
            $table->unique(['client_id','company_id','service_id','commune_id','date']);
            $table->foreign('client_id')->references('id')->on('clients')->onUpdate('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onUpdate('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onUpdate('cascade');
            $table->foreign('commune_id')->references('id')->on('communes')->onUpdate('cascade');
            $table->foreign('section_id')->references('id')->on('sections')->onUpdate('cascade');
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
        Schema::dropIfExists('orders');
    }
}
