<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments("id");
            $table->string('employee_first_name');
            $table->string('employee_last_name');
            $table->string('employee_email')->nullable();
            $table->string('employee_phone');
            $table->integer('company_id')->unsigned()->nullable();;
            $table->foreign('company_id')->nullable()->references('id')->on('companies');
            $table->string('created_username')->nullable();
            $table->string('updated_username')->nullable();
            $table->string('deleted_username')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
