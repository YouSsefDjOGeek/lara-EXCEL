<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('filename');
            $table->integer('id_uploader');
            $table->string('path');
            $table->foreign('id_uploader')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->string("slug")->unique();
            $table->text("comment")->nullable();
            $table->double('filesize')->default(0.0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}

