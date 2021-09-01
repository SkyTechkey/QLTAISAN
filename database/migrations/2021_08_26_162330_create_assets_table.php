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
            $table->integer('department_id')->unsigned();
            $table->integer('provide_id')->unsigned();
            $table->integer('property_type_id')->unsigned();
            $table->integer('property_group_id')->unsigned();

            $table->string('code');
            $table->string('name');
            $table->string('usage_status');             // tình trạng sử dụng
            $table->date('date_purchase');              // ngày mua
            $table->date('warranty_expires');           // hết hạn bảo hành
            $table->date('date_liquidation'); 
            $table->decimal('first_value',$precision = 19, $scale = 2);             // giá trị ban đầu
            $table->decimal('depreciation_per_year',$precision = 19, $scale = 2);   // khấu hao hàng năm (%)
            $table->decimal('depreciation',$precision = 19, $scale = 2);            // giá trị khấu hao
            $table->decimal('residual_value',$precision = 19, $scale = 2);          // giá trị còn lại
            // $table->float('maintenance_fee')->nullable();         // phí bảo dưỡng
            // $table->float('repair_fee')->nullable();              // phí sửa chữa
            $table->boolean('access_status')->nullable();           // tình trạng nhập xuất
            $table->text('note')->nullable();
            $table->longText('file')->nullable();

            $table->foreign('department_id')
            ->references('id')
            ->on('departments')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('property_type_id')
            ->references('id')
            ->on('property_type')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('property_group_id')
            ->references('id')
            ->on('property_group')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('provide_id')
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
