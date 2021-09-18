<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->smallInteger('is_student')
                ->default(0)
                ->index()
                ->comment('不等于0时为学生');
            $table->unsignedInteger('school_id')
                ->default(0)
                ->index()
                ->comment('所属学校');
            $table->smallInteger('is_teacher')
                ->default(0)
                ->index()
                ->comment('不等于0时为老师');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
