<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipt_notes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->string('deliver')->nullable();
            $table->string('position')->nullable();
            $table->string('location')->nullable();
            $table->integer('user_id')->unsigned();
            $table->date('date')->nullable();
            $table->text('note')->nullable();

            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receipt_notes');
    }
}
