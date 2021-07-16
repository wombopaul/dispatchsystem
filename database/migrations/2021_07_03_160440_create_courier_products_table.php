<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourierProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courier_products', function (Blueprint $table) {
            $table->id();
            $table->integer('courier_info_id');
            $table->integer('courier_type_id');
            $table->integer('qty')->default(1);
            $table->decimal('fee', 28,8)->default(0);
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
        Schema::dropIfExists('courier_products');
    }
}
