<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMobileMagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobile_mags', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('line')->comment('线号');
            $table->integer('station');
            $table->float('magvalue');
            $table->time('time');
            $table->date('date');
            $table->integer('ext')->comment('当前数据的信号强度');
            $table->integer('serial')->comment('当前仪器的型号');
            $table->integer('cordId')->nullable()->comment('测量数据编号');
            $table->float('basevalue')->nullable()->comment('日变数据');
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
        Schema::dropIfExists('mobile_mags');
    }
}
