<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSettingEmail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_email', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('setting_id')->index();
            $table->foreign('setting_id')->references('id')->on('setting')->onDelete('cascade');
            $table->string('protocal')->nullable();
            $table->string('parameter')->nullable();
            $table->string('hostname')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->string('smtp_port')->nullable();
            $table->string('encription')->nullable();
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
        Schema::dropIfExists('setting_email');
    }
}
