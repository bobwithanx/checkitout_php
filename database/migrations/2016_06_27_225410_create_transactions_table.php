<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->integer('resource_id')->unsigned();
            $table->timestamps();
        });
 
        // $table->foreign('student_id')
        //       ->references('id')
        //       ->on('students');
 
        // $table->foreign('resource_id')
        //       ->references('id')
        //       ->on('resources');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('transactions');
    }
}
