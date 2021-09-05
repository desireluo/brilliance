<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id');
            $table->string('sku')->default('');
            $table->string('barcode')->default('');
            $table->string('spec')->default('');
            $table->string('pic_url')->default('');
            $table->decimal('price');
            $table->integer('num');
            $table->integer('shop_id');
            $table->string('platform')->default('');
            $table->string('company')->default('');
            $table->string('bill_code')->default('');
            $table->string('print_data')->default('');
            $table->timestamp('created')->nullable();
            $table->timestamp('modified')->nullable();
            $table->integer('sku_id');
            $table->string('oid')->default('');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
