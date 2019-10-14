<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavigationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navigation', function (Blueprint $table) {
            $table->increments('NAV_ID');
            $table->string('NAV_DESCRIPTION');
            $table->string('ICON');
            $table->string('WINDOW_TYPE');
            $table->string('WINDOW_CLASS');
            $table->integer('PARENT');
            $table->integer('CHILD');
            $table->string('ROUTE')->nullable();
            $table->integer('ORDER');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('navigation');
    }
}
