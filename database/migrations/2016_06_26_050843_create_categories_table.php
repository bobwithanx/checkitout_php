<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Carbon\Carbon;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->string('icon');
            $table->timestamps();
        });

        DB::table('categories')->insert(array('name'=>'Camera', 'icon'=>'fa-camera', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()));
        DB::table('categories')->insert(array('name'=>'Tripod', 'icon'=>'fa-gears', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()));
        DB::table('categories')->insert(array('name'=>'Computer', 'icon'=>'fa-laptop', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()));
   }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('categories');
    }
}
