<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration
{
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('branch_id');
            $table->string('department_code');
            $table->string('name');
            $table->text('note')->nullable();

            $table->foreign('branch_id')
            ->references('id')
            ->on('branches')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }
    public function down()
    {
        Schema::dropIfExists('departments');
    }
}
