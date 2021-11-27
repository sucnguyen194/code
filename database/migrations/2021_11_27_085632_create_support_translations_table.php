<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('support_id')->constrained()->onDelete('cascade');
            $table->string('locale');
            $table->string('name')->nullable();
            $table->string('job')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('support_translations');
    }
}
