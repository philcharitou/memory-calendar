<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('event_photo_mapping', function (Blueprint $table) {
//            $table->increments('id');
//            // Identification Fields
//            $table->integer('event_id')->unsigned(); //Has Foreign
//            $table->integer('photo_id')->unsigned(); //Has Foreign
//
//            // Foreign Keys
//            $table->foreign('event_id')
//                ->references('id')
//                ->on('events')
//                ->onDelete('cascade');
//
//            $table->foreign('photo_id')
//                ->references('id')
//                ->on('photos')
//                ->onDelete('cascade');
//        });
        Schema::create('event_photos', function (Blueprint $table) {
            $table->increments('id');
            // Identification Fields
            $table->integer('event_id')->unsigned(); //Has Foreign
            $table->string('photo');

            // Foreign Keys
            $table->foreign('event_id')
                ->references('id')
                ->on('events')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_photos');
    }
};
