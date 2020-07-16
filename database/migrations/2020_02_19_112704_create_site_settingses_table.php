<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteSettingsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_settingses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('site_title');
            $table->string('site_logo');
            $table->string('address');
            $table->string('phone');
            $table->string('email_address');
            $table->string('order_admin_email');
            $table->string('reservation_admin_email');
            $table->string('contact_map_source_url');
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
        Schema::dropIfExists('site_settingses');
    }
}
