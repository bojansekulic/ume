<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCsvDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('csv_datas', function (Blueprint $table) {
            $table->increments('id');
            //$table->integer('user_id')->unsigned()->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');

//            $table->unsignedInteger('group_id')->nullable();
//            $table->foreign('group_id')->references('id')->on('groups');

            $table->string('csv_filename');
            $table->string('csv_header')->default(0);
            $table->longText('csv_data');
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
        Schema::dropIfExists('csv_datas');
    }
}
