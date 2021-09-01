<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailReceiptNotesTable extends Migration
{
    
    public function up()
    {
        Schema::create('detail_receipt_notes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('PN_id')->unsigned();
            $table->bigInteger('asset_id')->unsigned();
            $table->bigInteger('amount');
            $table->bigInteger('unit_price');
            $table->decimal('total',19,2);
            $table->text('note')->nullable();

            $table->foreign('PN_id')
            ->references('id')
            ->on('receipt_notes')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('asset_id')
            ->references('id')
            ->on('assets')
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
        Schema::dropIfExists('detail_receipt_notes');
    }
}
