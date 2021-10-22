<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTranslations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('post_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('menu_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('photo_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('support_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('attribute_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('locale');
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('path')->nullable();
            $table->string('job')->nullable();
            $table->longText('description')->nullable();
            $table->longText('content')->nullable();
            $table->longText('tag')->nullable();
            $table->string('title_seo')->nullable();
            $table->string('description_seo')->nullable();
            $table->json('option')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('translations');
    }
}
