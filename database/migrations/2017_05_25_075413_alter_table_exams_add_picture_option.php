<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableExamsAddPictureOption extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exams', function (Blueprint $table) {
            $table->string('pic_1')->nullable()->after('score');
            $table->string('pic_2')->nullable();
            $table->string('pic_3')->nullable();
            $table->string('pic_4')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exams', function (Blueprint $table) {
          $table->dropColumn([
            'pic_1', 'pic_2', 'pic_3', 'pic_4'
          ]);
        });
    }
}
