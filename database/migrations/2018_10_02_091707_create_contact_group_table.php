<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_group', function (Blueprint $table) {
            $table->increments('id');



            $table->integer('group_id')->unsigned()->unsigned();
            $table->foreign('group_id')->references('id')->on('groups');


            $table->integer('contact_id')->unsigned()->unsigned();
            $table->foreign('contact_id')->references('id')->on('contacts');

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
        Schema::dropIfExists('contact_group');
    }
}
