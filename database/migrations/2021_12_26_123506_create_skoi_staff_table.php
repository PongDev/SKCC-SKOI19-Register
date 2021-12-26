<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateSkoiStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SKOI_Staff', function (Blueprint $table) {
            $table->string('User', 255);
            $table->string('Password', 255); // Old System Password Mechanic Didn't Hash
            $table->timestamp('registerTime')->nullable(false)->useCurrent();
            $table->timestamp('lastLogin')->nullable(false)->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skoi_staff');
    }
}
