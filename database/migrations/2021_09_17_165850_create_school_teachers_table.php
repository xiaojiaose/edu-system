<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_teachers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('school_id')
                ->index()
                ->comment('学校id');
            $table->unsignedInteger('teacher_id')
                ->index()
                ->comment('教师id');
            $table->int('is_manager')
                ->default(0)
                ->comment('1为学校管理员');
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
        Schema::dropIfExists('school_teachers');
    }
}
