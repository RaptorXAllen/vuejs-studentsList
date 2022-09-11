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
        Schema::create('students', function (Blueprint $table) {
            $table->increments('ID');
            $table->string('LastName');
            $table->string('FirstName');
            $table->string('City');
            $table->string('State');
            $table->string('Gender');
            $table->string('StudentStatus');
            $table->string('Major');
            $table->string('Country');
            $table->integer('Age');
            $table->integer('SAT');
            $table->integer('Grade');
            $table->integer('Height');
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
};
