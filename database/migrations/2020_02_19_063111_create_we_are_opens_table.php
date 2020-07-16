<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeAreOpensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('we_are_opens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('heading');
            $table->string('sub_heading');
            $table->string('first_box_icon');
            $table->string('first_box_heading');
            $table->string('first_box_sub_heading');
            $table->string('second_box_icon');
            $table->string('second_box_heading');
            $table->string('second_box_sub_heading');
            $table->string('third_box_icon');
            $table->string('third_box_heading');
            $table->string('third_box_sub_heading');
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
        Schema::dropIfExists('we_are_opens');
    }
}
