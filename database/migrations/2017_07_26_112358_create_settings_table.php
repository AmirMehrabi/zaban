<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('shortName')->nullable();
            $table->string('fullName')->nullable();
            $table->string('direction')->default('fa');
            $table->string('intro1_title')->nullable();
            $table->string('intro1_description')->nullable();
            $table->string('intro1_picture')->nullable();
            $table->string('intro2_title')->nullable();
            $table->string('intro2_description')->nullable();
            $table->string('intro2_picture')->nullable();
            $table->string('intro3_title')->nullable();
            $table->string('intro3_description')->nullable();
            $table->string('intro3_picture')->nullable();
            $table->string('intro4_title')->nullable();
            $table->string('intro4_description')->nullable();
            $table->string('intro4_picture')->nullable();
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
        Schema::drop('settings');
    }
}
