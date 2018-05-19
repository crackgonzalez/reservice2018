<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quote_id')->unsigned();
            $table->integer('company_id')->unsigned();
            $table->integer('state_company')->default(0);
            $table->integer('state_client')->default(0);
            $table->string('description',200)->nullable();
            $table->integer('price')->nullable();
            $table->unique(['quote_id','company_id']);
            $table->foreign('quote_id')->references('id')->on('quotes')->onUpdate('cascade');
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
        Schema::dropIfExists('responses');
    }
}
