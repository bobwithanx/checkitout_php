<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Carbon\Carbon;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        DB::table('groups')->insert(array('name'=>'Period 1-2', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()));
        DB::table('groups')->insert(array('name'=>'Period 3-4', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()));
        DB::table('groups')->insert(array('name'=>'Period 7-8', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('groups');
    }
}
