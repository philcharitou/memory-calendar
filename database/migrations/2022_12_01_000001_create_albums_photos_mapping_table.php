<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumsPhotosMappingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('albums_photos_mapping', function (Blueprint $table) {
            $table->increments('id');
            // Identification Fields
            $table->integer('album_id')->unsigned(); //Has Foreign
            $table->integer('photo_id')->unsigned(); //Has Foreign
            // Pivot Field(s)

            // Foreign Keys
            $table->foreign('album_id')
                ->references('id')
                ->on('albums')
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
        Schema::dropIfExists('albums_photos_mapping');
    }
}
