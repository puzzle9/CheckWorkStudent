<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSignDormRemarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sign_dorm_remarks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('school_id')->index();
            $table->unsignedBigInteger('dorm_id')->index();
            $table->unsignedBigInteger('shift_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->date('date')->index();
            $table->text('body')->nullable();
            $table->timestamps();

            $table->index(['date', 'shift_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sign_dorm_remarks');
    }
}
