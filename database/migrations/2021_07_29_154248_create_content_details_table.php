<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_details', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->text('link');
            $table->text('link_thumbnail')->nullable();
            $table->text('type');
            $table->text('size');
            $table->text('note')->nullable();
            $table->unsignedInteger('content_id');
            $table->string('department_code');
            $table->string('privacy')->nullable();
            $table->date('deleted_at')->nullable();
            $table->foreign('content_id')
            ->references('id')
            ->on('contents')
            ->onUpdate('cascade')
            ->onDelete('cascade');
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
        Schema::dropIfExists('content_details');
    }
}
