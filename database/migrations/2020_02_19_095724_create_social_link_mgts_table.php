<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialLinkMgtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_link_mgts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('facebook');
            $table->string('twitter');
            $table->string('linkin');
            $table->string('google_plus');
            $table->string('pinterest');
            $table->string('instagram');
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
        Schema::dropIfExists('social_link_mgts');
    }
}
