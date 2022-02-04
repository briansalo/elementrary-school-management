<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeGeneratePayrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_generate_payrolls', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id')->nullable();
            $table->date('from')->nullable();
            $table->date('to')->nullable();
            $table->double('salary')->nullable();
            $table->integer('no_of_days')->nullable();
            $table->double('sub_total')->nullable();
            $table->double('late')->nullable();
            $table->double('overtime')->nullable();
            $table->integer('deduction')->nullable();
            $table->double('total_salary')->nullable();
            $table->integer('status')->default(0)->comment('0=unsave, 1=save');
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
        Schema::dropIfExists('employee_generate_payrolls');
    }
}
