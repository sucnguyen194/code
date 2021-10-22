<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code', 50)->nullable()->unique();
            $table->unsignedDecimal('value',15, 2);
            $table->tinyInteger('value_type');

            //quantity
            $table->integer('uses_total');
            $table->integer('uses_user');

            //conditions
            $table->unsignedDecimal('minimum_amount',15, 2)->nullable();
            $table->unsignedInteger('minimum_quantity')->nullable();

            //time
            $table->timestamp('start_at')->nullable();
            $table->timestamp('end_at')->nullable();
            $table->string('user_selection')->default('all');

            $table->json('conditions')->nullable();
            $table->boolean('public');
            $table->tinyInteger('status');
            $table->string('description')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('discounts');
    }
}
