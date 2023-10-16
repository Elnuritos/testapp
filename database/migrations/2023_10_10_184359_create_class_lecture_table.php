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
        Schema::create('class_lecture', function (Blueprint $table) {
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('lecture_id');
            $table->integer('order')->unsigned();

            $table->unique(['class_id', 'lecture_id']);
            $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');
            $table->foreign('lecture_id')->references('id')->on('lectures')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_lecture');
    }
};
