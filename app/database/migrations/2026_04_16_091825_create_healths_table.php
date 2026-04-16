<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHealthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('healths', function (Blueprint $table) {
            $table->increments('id');
            $table->date('health_date');
            $table->tinyInteger('energy')
                  ->default(0)
                  ->comment('0=◎, 1=◯, 2=△, 3=×');
            $table->tinyInteger('appetite')
                  ->default(0)
                  ->comment('0=◎, 1=◯, 2=△, 3=×');
            $table->tinyInteger('toilets')
                  ->default(0)
                  ->comment('0=◎, 1=◯, 2=△, 3=×');
            $table->integer('walk_minutes')->nullable();
            $table->decimal('weight', 5, 2)->nullable();
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
        Schema::dropIfExists('healths');
    }
}
