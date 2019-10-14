<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcurementLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procurement_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('procurement_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            $table->string('notes')->nullable();
            $table->integer('status');
            $table->timestamps();

            $table->foreign('procurement_id')->references('id')->on('procurements');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('procurement_logs');
    }
}
