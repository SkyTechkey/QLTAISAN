<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_uploads', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('asset_id')->unsigned();
            $table->unsignedInteger('assets_detail_id')->nullable();
            $table->bigInteger('receipt_note_id')->unsigned()->nullable();
            $table->bigInteger('delivery_note_id')->unsigned()->nullable();
            $table->string('name');
            $table->string('path');

            $table->foreign('asset_id')
            ->references('id')
            ->on('assets')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('assets_detail_id')
            ->references('id')
            ->on('assets_details')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('receipt_note_id')
            ->references('id')
            ->on('receipt_notes')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('delivery_note_id')
            ->references('id')
            ->on('delivery_notes')
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
        Schema::dropIfExists('file_uploads');
    }
}
