<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('translations', function (Blueprint $table) {
            $table->after('content',function ($table){
               $table->longtext('feature')->nullable();
                $table->longtext('function')->nullable();
                $table->longtext('tutorial')->nullable();
                $table->longtext('question')->nullable();
                $table->longtext('ingredient')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('translations', function (Blueprint $table) {
            $table->dropColumn('feature');
            $table->dropColumn('function');
            $table->dropColumn('tutorial');
            $table->dropColumn('question');
            $table->dropColumn('ingredient');
        });
    }
}
