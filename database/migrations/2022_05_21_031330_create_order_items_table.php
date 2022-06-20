<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->decimal('price', 10, 2)->unsigned();
            $table->tinyInteger('quantity')->unsigned()->default(1);
            $table->decimal('cost', 10, 2)->unsigned();
            // внешний ключ, ссылается на поле id таблицы orders
            $table->foreignId('order_id')
                ->references('id')
                ->on('orders')
                ->OnDelete('cascade');
            // внешний ключ, ссылается на поле id таблицы products
            $table->foreignId('product_id')
                ->references('id')
                ->on('products')
                ->OnDelete('null');
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
};
