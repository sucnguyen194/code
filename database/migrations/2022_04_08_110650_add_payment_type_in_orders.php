<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentTypeInOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->after('total', function ($table){
                $table->foreignId('product_id')->constrained();
                $table->integer('payment_type')->nullable();
                $table->string('payment_code')->nullable();
                $table->integer('amount')->default(1);
                $table->decimal('usd', 5,2)->default(0);
                $table->integer('rate')->default(0);
                $table->integer('vnd')->default(0);
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
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('payment_type');
        });
    }
}
