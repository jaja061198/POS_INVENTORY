<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company', function (Blueprint $table) {
            $table->increments('id');
            $table->string('COMPANY_NAME');
            $table->string('ADDRESS');
            $table->string('ZIP_CODE')->nullable();
            $table->string('TIN_NO')->nullable();
            $table->string('PHONE_NO')->nullable();
            $table->string('FAX')->nullable();
            $table->string('WEBSITE')->nullable();
            $table->string('LOGO')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company');
    }
}
