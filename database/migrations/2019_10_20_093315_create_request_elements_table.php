<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_elements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('type');
            $table->text('value');
            $table->boolean('validation');
            $table->text('placeholder');

            $table->unsignedInteger('request_form_id');
            $table->foreign('request_form_id')->references('id')->on('request_forms');
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
        Schema::dropIfExists('request_elements');
    }
}
