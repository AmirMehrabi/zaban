<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('title');
            $table->integer('author_id');
            $table->integer('category_id')->default(1);
            $table->string('picture')->nullable();
            $table->text('excerpt')->nullable();
            $table->text('body');
            $table->integer('viewers_counter')->default(1);
            $table->boolean('is_special')->default(0);
            $table->timestamp('jalali_date')->nullable();
            $table->timestamp('published_at')->nullable();
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
        Schema::drop('posts');
    }
}
