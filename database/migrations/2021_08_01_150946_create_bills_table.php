<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('')->comment('主题');
            $table->integer('type')->default('0')->comment('类别');
            $table->decimal('money')->default('0')->comment('金额');
            $table->date('paid_at')->comment('支付时间');
            $table->string('remark')->default('')->comment('备注');
            $table->integer('admin_user_id')->default('0')->comment('记录人');
            $table->string('screenshot')->default('')->comment('截图');
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
        Schema::dropIfExists('bills');
    }
}
