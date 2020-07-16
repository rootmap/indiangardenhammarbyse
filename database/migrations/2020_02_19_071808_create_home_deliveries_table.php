<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomeDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_deliveries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('heading');
            $table->string('first_logo');
            $table->string('first_logo_link');
            $table->string('second_logo');
            $table->string('second_logo_link');
            $table->string('third_logo');
            $table->string('third_logo_link');
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
        Schema::dropIfExists('home_deliveries');
    }
}
