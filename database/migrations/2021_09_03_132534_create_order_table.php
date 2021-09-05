<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('')->comment('名称');
            $table->string('state')->default('')->comment('省');
            $table->string('city')->default('')->comment('市');
            $table->string('district')->default('');
            $table->string('address')->default('');
            $table->string('custom_id')->default('');
            $table->string('specification')->default('')->comment('规格');
            $table->string('barcode')->default('')->comment('条形码');
            $table->string('platform')->default('')->comment('平台');
            $table->decimal('price')->nullable();
            $table->integer('shop_id');
            $table->string('buyer_nick')->default('');
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
        Schema::dropIfExists('order');
    }
}
