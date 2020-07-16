<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomeOrderDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_order_deliveries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('heading');
            $table->string('first_icon');
            $table->string('first_icon_text');
            $table->string('second_icon');
            $table->string('second_icon_text');
            $table->string('third_icon');
            $table->string('third_icon_text');
            $table->string('module_status');
            $table->integer('store_id');
            $table->integer('created_by');
            $table->integer('updated_by');
            
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
        Schema::dropIfExists('home_order_deliveries');
    }
}
