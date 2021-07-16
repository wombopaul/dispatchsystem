<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourierInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courier_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('invoice_id');
            $table->string('code');
            $table->integer('sender_branch_id');
            $table->integer('sender_staff_id');
            $table->string('sender_name')->nullable();
            $table->string('sender_email',40)->nullable();
            $table->string('sender_phone',40)->nullable();
            $table->string('sender_address')->nullable();
            $table->integer('receiver_branch_id')->nullable();
            $table->integer('receiver_staff_id')->nullable();
            $table->string('receiver_name')->nullable();
            $table->string('receiver_email',40)->nullable();
            $table->string('receiver_phone',40)->nullable();
            $table->string('receiver_address')->nullable();
            $table->tinyInteger('status')->default(0)->comment("Received : 0, Delivery : 1");
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
        Schema::dropIfExists('courier_infos');
    }
}
