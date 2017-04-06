<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinkTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('link_tag', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('link_id')->unsigned();
            $table->integer('tag_id')->unsigned();
            
            $table->foreign('link_id')->references('id')->on('links');
            $table->foreign('tag_id')->references('id')->on('tags');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('link_tag');
    }
}
