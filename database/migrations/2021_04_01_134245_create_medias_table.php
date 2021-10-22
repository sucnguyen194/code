<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('path')->nullable();
            $table->string('image')->nullable();
            $table->string('thumb')->nullable();
            $table->longText('description')->nullable();
            $table->string('position')->nullable();
            $table->integer('type_id')->default(0);
            $table->string('type')->nullable();
            $table->integer('admin_id')->nullable();
            $table->integer('admin_edit')->nullable();
            $table->integer('public')->default(1);
            $table->integer('sort')->default(0);
            $table->string('lang')->default(session()->get('lang') ?? null);
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
        Schema::dropIfExists('photos');
    }
}
