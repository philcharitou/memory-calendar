<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsPhotosMappingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events_photos_mapping', function (Blueprint $table) {
            $table->increments('id');
            // Identification Fields
            $table->integer('event_id')->unsigned(); //Has Foreign
            $table->integer('photo_id')->unsigned(); //Has Foreign

            // Foreign Keys
            $table->foreign('event_id')
                ->references('id')
                ->on('events')
                ->onDelete('cascade');

            $table->foreign('photo_id')
                ->references('id')
                ->on('photos')
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
        Schema::dropIfExists('events_photos_mapping');
    }
}
