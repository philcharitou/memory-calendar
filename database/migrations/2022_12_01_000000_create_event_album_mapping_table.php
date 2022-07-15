<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventAlbumMappingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_album_mapping', function (Blueprint $table) {
            $table->increments('id');
            // Identification Fields
            $table->integer('event_id')->unsigned(); //Has Foreign
            $table->integer('album_id')->unsigned(); //Has Foreign
            // Pivot Field(s)

            // Foreign Keys
            $table->foreign('event_id')
                ->references('id')
                ->on('events')
                ->onDelete('cascade');

            $table->foreign('album_id')
                ->references('id')
                ->on('albums')
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
        Schema::dropIfExists('event_album_mapping');
    }
}
