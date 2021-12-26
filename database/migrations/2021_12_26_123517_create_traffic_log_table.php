<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrafficLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Traffic_Log', function (Blueprint $table) {
            $table->string('request_ip', 255);
            $table->string('request_user_agent', 255);
            $table->string('request_page', 32);
            $table->string('request_method', 32);
            $table->timestamp('request_time');

            $table->timestamp('timestamp')->nullable(false)->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('traffic_log');
    }
}
