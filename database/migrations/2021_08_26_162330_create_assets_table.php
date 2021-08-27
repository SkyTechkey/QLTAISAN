<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsTable extends Migration
{
   
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_branch')->unsigned();
            $table->integer('id_provide')->unsigned();
            $table->integer('id_property_type')->unsigned();
            $table->integer('id_property_group')->unsigned();

            $table->string('code');
            $table->string('name');
            $table->string('group');
            $table->string('usage_status');               // tình trạng sử dụng
            $table->string('image')->nullable();
            $table->date('date_purchase');              // ngày mua
            $table->date('warranty_expires');           // hết hạn bảo hành
            $table->date('date_liquidation');           // thời gian thanh lý
            $table->decimal('first_value');             // giá trị ban đầu
            $table->decimal('depreciation_per_year');   // khấu hao hàng năm (%)
            $table->decimal('depreciation');           // giá trị khấu hao
            $table->decimal('residual_value');          // giá trị còn lại
            $table->decimal('maintenance_fee');         // phí bảo dưỡng
            $table->decimal('repair_fee');              // phí sửa chữa
            $table->boolean('access_status');       // tình trạng nhập xuất
            $table->text('note')->nullable();

            $table->foreign('id_branch')
            ->references('id')
            ->on('branches')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('id_property_type')
            ->references('id')
            ->on('property_type')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('id_property_group')
            ->references('id')
            ->on('property_group')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('id_provide')
            ->references('id')
            ->on('provide')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('assets');
    }
}
