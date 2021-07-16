<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourierPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courier_payments', function (Blueprint $table) {
            $table->id();
            $table->integer('courier_info_id');
            $table->integer('receiver_id')->nullable();
            $table->integer('branch_id')->nullable();
            $table->integer('transaction_id')->nullable();
            $table->date('date')->nullable();
            $table->decimal('amount', 28,8)->default(0);
            $table->tinyInteger('status')->default(0)->comment("Unpaid : 0, Paid : 1");
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
        Schema::dropIfExists('courier_payments');
    }
}
