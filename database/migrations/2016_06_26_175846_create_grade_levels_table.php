<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Carbon\Carbon;

class CreateGradeLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grade_levels', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        DB::table('grade_levels')->insert(array('name'=>'Film 1-2', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()));
        DB::table('grade_levels')->insert(array('name'=>'Film 3-4', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('grade_levels');
    }
}
