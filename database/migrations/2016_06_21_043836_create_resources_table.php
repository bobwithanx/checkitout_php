<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Carbon\Carbon;

class CreateResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('category_id')->unsigned();
            $table->string('inventory_tag')->unique();
            $table->string('serial_number')->nullable();
            $table->boolean('is_available')->default(true);
            $table->timestamps();

            $table->foreign('category_id')
                  ->references('id')
                  ->on('categories');
        });

        DB::table('resources')->insert(array('name'=>'Canon XA25', 'inventory_tag'=>'1234', 'category_id'=>1, 'serial_number'=>'AAXXAA213', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()));
        DB::table('resources')->insert(array('name'=>'Canon C100', 'inventory_tag'=>'C100-1', 'category_id'=>1, 'serial_number'=>'AB123', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('resources');
    }
}
