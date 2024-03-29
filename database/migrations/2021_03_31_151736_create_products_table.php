<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('price', 16, 2)->default(0);
            $table->decimal('price_sale', 16, 2)->default(0);
            $table->integer('amount')->default(0);
            $table->string('code')->nullable();
            $table->longText('photo')->nullable();
            $table->integer('category_id')->default(0);
            $table->integer('admin_id');
            $table->integer('admin_edit')->nullable();
            $table->integer('view')->default(0);
            $table->integer('public')->default(1);
            $table->integer('status')->default(2);
            $table->integer('sort')->default(0);
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
        Schema::dropIfExists('products');
    }
}
