<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassStudentGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_student_grades', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id')->nullable();
            $table->integer('student_id')->nullable();
            $table->integer('grade_id')->nullable();
            $table->integer('class_id')->nullable();
            $table->double('grade')->nullable();
            $table->tinyInteger('grading')->nullable()->comment('1=1st, 2=2nd, 3=3rd, 4=4th');
            $table->string('subject')->nullable();
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
        Schema::dropIfExists('class_student_grades');
    }
}
