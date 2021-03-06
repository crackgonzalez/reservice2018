<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned();
            $table->integer('service_id')->unsigned();
            $table->integer('commune_id')->unsigned();
            $table->integer('section_id')->unsigned()->nullable();
            $table->integer('company_id')->unsigned()->nullable();
            $table->boolean('model')->default(false);
            $table->integer('state_company')->default(0);
            $table->integer('state_client')->default(0);
            $table->date('date');
            $table->string('image')->nullable();
            $table->string('description',200);
            $table->string('answer',200)->nullable();
            $table->unique(['client_id','company_id','service_id','commune_id','date']);
            $table->foreign('client_id')->references('id')->on('clients')->onUpdate('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onUpdate('cascade');
            $table->foreign('commune_id')->references('id')->on('communes')->onUpdate('cascade');
            $table->foreign('section_id')->references('id')->on('sections')->onUpdate('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onUpdate('cascade');
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
        Schema::dropIfExists('quotes');
    }
}
