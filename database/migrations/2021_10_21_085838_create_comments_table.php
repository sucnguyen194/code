<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->nullableMorphs('comment');
            $table->foreignId('admin_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->longText('comment');
            $table->string('rate')->nullable();
            $table->integer('parent_id')->default(0);
            $table->integer('status')->default(2);
            $table->integer('hidden')->default(1);
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
        Schema::dropIfExists('comments');
    }
}
