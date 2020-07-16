<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebsiteSettingsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_settingses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('website_meta_data');
            $table->string('website_meta_description');
            $table->string('footer_image');
            $table->string('bottom_icon');
            $table->string('book_table_button_content');
            $table->string('overlay');
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
        Schema::dropIfExists('website_settingses');
    }
}
