<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppartementsTable extends Migration
{
    public function up()
    {
        Schema::create('appartements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('block_id')->constrained()->onDelete('cascade');
            $table->string('floor');
            $table->integer('number');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('appartements');
    }
}
