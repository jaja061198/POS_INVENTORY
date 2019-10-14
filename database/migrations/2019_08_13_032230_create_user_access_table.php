<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAccessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_access', function (Blueprint $table) {
            $table->increments('id');
            $table->string('USER_ID',50);
            $table->string('NAV_ID',50);
            $table->string('VIEW',50)->default(0);
            $table->string('ADD',50)->default(0);
            $table->string('EDIT',50)->default(0);
            $table->string('PRINT',50)->default(0);
            $table->string('SPCL_ACCESS',50)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_access');
    }
}
