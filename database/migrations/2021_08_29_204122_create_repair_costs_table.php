<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepairCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repair_costs', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('asset_id')->unsigned();
            $table->unsignedInteger('provide_id')->nullable();
            $table->date('date');
            $table->decimal('cost', 19, 2);
            $table->text('details')->nullable();

            $table->foreign('asset_id')
            ->references('id')
            ->on('assets')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('provide_id')
            ->references('id')
            ->on('provide')
            ->onUpdate('cascade')
            ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repair_costs');
    }
}
