<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id');
          $table->integer('course_id');
          $table->text('question');
          $table->text('opt_1');
          $table->text('opt_2');
          $table->text('opt_3');
          $table->text('opt_4');
          $table->integer('is_correct');
          $table->integer('score')->nullable()->default(2);
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
        Schema::drop('exams');
    }
}
