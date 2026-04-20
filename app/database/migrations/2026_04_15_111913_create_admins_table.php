<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('email', 255)->unique();
            $table->string('password', 225);
            $table->tinyInteger('del_flg')
                  ->default(0)
                  ->comment('0=有効, 1=削除');
            $table->rememberToken(); //ログイン状態を保持する
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
        Schema::dropIfExists('admins');
    }
}
