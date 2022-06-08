<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_submissions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();

            $table->string('nationality')->nullable();
            $table->string('state')->nullable();
            $table->string('address')->nullable();
            $table->string('dob')->nullable();
            $table->string('under_contract')->nullable();
            $table->integer('contract_duration')->nullable();
            $table->string('health_condition')->nullable();
            $table->string('health_condition_desc')->nullable();

            $table->string('guardian_name')->nullable();
            $table->string('guardian_phone')->nullable();
            $table->string('guardian_address')->nullable();

            $table->string('video_id')->nullable();
            
            $table->string('transaction_id')->nullable();
            $table->string('status')->default('active');

            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('application_submissions');
    }
}
