<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('name',60);
            $table->string('area',45);
            $table->string('approach',45);
            $table->string('type',45);
            $table->string('grade',45);
            $table->string('image');
            $table->unsignedbigInteger('modality_id');
            $table->foreign('modality_id')->references('id')->on('modalities')->onDelete('cascade');
            $table->unsignedbigInteger('system_id');
            $table->foreign('system_id')->references('id')->on('systems')->onDelete('cascade');
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
        Schema::dropIfExists('programs');
    }
}
