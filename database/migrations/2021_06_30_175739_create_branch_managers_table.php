<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_managers', function (Blueprint $table) {
            $table->id();
            $table->integer('branch_id');
            $table->string('firstname',40)->nullable();
            $table->string('lastname', 40)->nullable();
            $table->string('username',40)->nullable()->unique();
            $table->string('email',40)->nullable()->unique();
            $table->string('phone', 40)->nullable()->unique();
            $table->string('show_password')->nullable();
            $table->string('password')->nullable();
            $table->tinyInteger('status')->default(0)->comment('Active 1 , Inactive 2');
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
        Schema::dropIfExists('branch_managers');
    }
}
