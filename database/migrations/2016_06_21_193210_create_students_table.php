<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Carbon\Carbon;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('id_number')->unique();
            $table->integer('group_id')->unsigned()->nullable();
            $table->integer('grade_level_id')->unsigned()->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->foreign('group_id')
                  ->references('id')
                  ->on('groups');
              
            $table->foreign('grade_level_id')
                  ->references('id')
                  ->on('grade_levels');
       });

        DB::table('students')->insert(array('first_name'=>'George', 'last_name'=>'Washington', 'id_number'=>'1776', 'group_id'=>1, 'grade_level_id'=>2, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()));
        DB::table('students')->insert(array('first_name'=>'Joe', 'last_name'=>'Dumars', 'id_number'=>'04', 'group_id'=>1, 'grade_level_id'=>1, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()));
        DB::table('students')->insert(array('first_name'=>'James', 'last_name'=>'Bond', 'id_number'=>'007', 'group_id'=>2, 'grade_level_id'=>2, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('students');
    }
}