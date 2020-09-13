<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('bed_name')->index();
            $table->string('name')->index();
            $table->string('phone')->nullable();
            $table->string('parent_type')->nullable();
            $table->string('parent_phone')->nullable();
            $table->string('remark')->nullable();
            $table->unsignedBigInteger('school_id')->index();
            $table->unsignedBigInteger('dorm_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('sort')->nullable()->comment('排序')->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
