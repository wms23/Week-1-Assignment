<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transation_details', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('transation_id');
            $table->foreign('transation_id')
                ->references('id')
                ->on('transations')
                ->onDelete('cascade');

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');

            $table->integer('qty');

            $table->decimal('cost');

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
        Schema::dropIfExists('transation_details');
    }
}
