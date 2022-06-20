<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressEnterprisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address_enterprises', function (Blueprint $table) {
            $table->id();
            $table->string('street',100);
            $table->string('zip_code',20);
            $table->bigInteger('number');
            $table->text('description');
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->unsignedbigInteger('enterprise_id')->unique();
            $table->foreign('enterprise_id')->references('id')->on('enterprises')->onDelete('cascade');
            $table->unsignedbigInteger('locality_id');
            $table->foreign('locality_id')->references('id')->on('localities')->onDelete('cascade');
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
        Schema::dropIfExists('address_enterprises');
    }
}
