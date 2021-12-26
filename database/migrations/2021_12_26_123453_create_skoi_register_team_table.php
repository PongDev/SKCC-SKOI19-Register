<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkoiRegisterTeamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SKOI_Register_Team', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_bin';
            $table->string('teamschool', 255);
            $table->string('teamname', 255)->nullable(false)->primary();
            $table->string('teamteachername', 255);
            $table->string('teamteachersurname', 255);
            $table->string('teamteacherphone', 32);

            $table->string('member1name', 255);
            $table->string('member1surname', 255);
            $table->string('member1class', 16);
            $table->string('member1email', 255);
            $table->string('member1phone', 32);
            $table->string('member1parentname', 255);
            $table->string('member1parentphone', 32);

            $table->string('member2name', 255);
            $table->string('member2surname', 255);
            $table->string('member2class', 16);
            $table->string('member2email', 255);
            $table->string('member2phone', 32);
            $table->string('member2parentname', 255);
            $table->string('member2parentphone', 32);

            $table->timestamp('registertime')->nullable(false)->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('SKOI_Register_Team');
    }
}
