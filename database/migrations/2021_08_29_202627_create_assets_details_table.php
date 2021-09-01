<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets_details', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('asset_id')->unsigned();
            // $table->unsignedInteger('user_id')->nullable();
            $table->string('accessory_name');
            $table->decimal('value', 19, 2);            
            $table->text('tech_info')->nullable();

            $table->foreign('asset_id')
            ->references('id')
            ->on('assets')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            // $table->foreign('user_id')
            // ->references('id')
            // ->on('users')
            // ->onUpdate('cascade')
            // ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assets_details');
    }
}
