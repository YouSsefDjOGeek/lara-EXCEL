<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_data', function (Blueprint $table) {
            $table->integer('id');
            $table->string('DAT_MaterialNumber')->nullable();
            $table->integer('DAT_RemainOrderQty')->default(0);
            $table->integer('DAT_Revesion_level')->default(0);
            $table->double('DAT_work_center')->default(0);
            $table->date('DAT_Released_On')->nullable();
            $table->string('DAT_Relased_by')->nullable();
            $table->foreign('id')->references('id')->on('files')->onDelete('cascade');

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
        Schema::dropIfExists('file_data');
    }
}
