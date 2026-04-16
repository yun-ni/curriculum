<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->increments('id');
            $table->date('visit_date');
            $table->tinyInteger('has_visit')
                  ->default(0)
                  ->comment('0=有, 1=無');
            $table->string('hospital_name', 50)->nullable();
            $table->string('symptom', 200);
            $table->string('medication', 200)->nullable();
            $table->string('prescription', 200)->nullable();
            $table->unsignedBigInteger('medical_fees')->nullable();
            $table->string('memo', 1000)->nullable();
            $table->timestamps();
            $table->unsignedInteger('pet_id');
            $table->foreign('pet_id')->references('id')->on('pets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visits');
    }
}
