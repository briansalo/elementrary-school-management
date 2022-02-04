<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeSallaryLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_sallary_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id')->comment('employee_id = User_id');
            $table->integer('previous_salary')->nullable();
            $table->integer('present_salary')->nullable();
            $table->integer('increment_salary')->nullable();
            $table->date('effective_salary')->nullable();
            $table->tinyInteger('status')->nullable()->comment('0=cancel, 1=on_process, 2=sucess');
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
        Schema::dropIfExists('employee_sallary_logs');
    }
}
