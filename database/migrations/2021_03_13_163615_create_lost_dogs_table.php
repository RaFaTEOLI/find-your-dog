<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLostDogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lost_dogs', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("description");
            $table->string("last_seen_at");
            $table->foreignId("posted_by")->nullable();
            $table->foreignId("found_by")->nullable();
            $table->string("found_at")->nullable();
            $table->timestamps();

            $table->foreign('posted_by')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('found_by')->references('id')->on('users')
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
        Schema::dropIfExists('lost_dogs');
    }
}
