<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommuneCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commune_company', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('commune_id')->unsigned();
            $table->integer('company_id')->unsigned();
            $table->unique(['commune_id','company_id']);
            $table->foreign('commune_id')->references('id')->on('communes')->onUpdate('cascade');
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
        Schema::dropIfExists('commune_company');
    }
}
