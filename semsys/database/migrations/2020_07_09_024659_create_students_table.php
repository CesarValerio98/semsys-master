<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name',60);
            $table->string('f_surname',45);
            $table->string('s_surname',45);
            $table->string('phone', 20);
            $table->string('school_email',100)->unique();
            $table->string('personal_email',100)->unique();
            $table->string('cv', 50);
            $table->string('status', 50);
            $table->string('image');
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
        Schema::dropIfExists('students');
    }
}
