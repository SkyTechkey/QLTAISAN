<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailDeliveryNotesTable extends Migration
{
    
    public function up()
    {
        Schema::create('detail_delivery_notes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('PX_id')->unsigned();
            $table->bigInteger('asset_id')->unsigned();
            $table->bigInteger('amount');
            $table->bigInteger('unit_price');
            $table->decimal('total',19,2);
            $table->text('note')->nullable();

            $table->foreign('PX_id')
            ->references('id')
            ->on('delivery_notes')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('asset_id')
            ->references('id')
            ->on('assets')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('detail_delivery_notes');
    }
}
