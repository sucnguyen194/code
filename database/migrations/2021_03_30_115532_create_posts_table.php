<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->longText('photo')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('admin_id')->nullable();
            $table->integer('admin_edit')->nullable();
            $table->integer('view')->default(0);
            $table->integer('status')->default(2);
            $table->integer('public')->default(1);
            $table->integer('sort')->default(0);
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
        Schema::dropIfExists('posts');
    }
}
