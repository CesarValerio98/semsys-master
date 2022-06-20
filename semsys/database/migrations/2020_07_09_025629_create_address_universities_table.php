<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressUniversitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address_universities', function (Blueprint $table) {
            $table->id();
            $table->string('street',100);
            $table->string('zip_code',20);
            $table->bigInteger('number');
            $table->string('campus',50);
            $table->text('description');
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->unsignedbigInteger('locality_id');
            $table->foreign('locality_id')->references('id')->on('localities')->onDelete('cascade');
            $table->unsignedbigInteger('university_id');
            $table->foreign('university_id')->references('id')->on('universities')->onDelete('cascade');
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
        Schema::dropIfExists('address_universities');
    }
}
