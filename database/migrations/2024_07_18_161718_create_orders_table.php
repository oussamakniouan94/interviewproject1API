<?php

use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $collection) {
            $collection->index('items');
            $collection->decimal('total', 8, 2);
            $collection->string('shipping_name');
            $collection->string('shipping_address');
            $collection->string('shipping_city');
            $collection->string('shipping_state');
            $collection->string('shipping_zip');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
