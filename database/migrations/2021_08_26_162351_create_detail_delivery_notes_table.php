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
            $table->bigInteger('id_PX')->unsigned();
            $table->bigInteger('id_asset')->unsigned();
            $table->bigInteger('amount');
            $table->bigInteger('unit_price');
            $table->decimal('total');
            $table->text('note')->nullable();

            $table->foreign('id_PX')
            ->references('id')
            ->on('delivery_notes')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('id_asset')
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
