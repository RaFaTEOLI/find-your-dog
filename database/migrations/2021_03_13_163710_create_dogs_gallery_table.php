<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDogsGalleryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dogs_gallery', function (Blueprint $table) {
            $table->id();
            $table->string("photo_url");
            $table->foreignId("lost_dog_id")->nullable();
            $table->timestamps();

            $table->foreign('lost_dog_id')->references('id')->on('lost_dogs')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dogs_gallery');
    }
}
