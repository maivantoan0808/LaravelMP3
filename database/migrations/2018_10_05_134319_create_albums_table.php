<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateAlbumsTable.
 */
class CreateAlbumsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('albums', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('name');
            $table->string('slug');
            $table->string('image')->default('default.jpg');
            $table->string('description')->nullable();
            $table->integer('count_listen')->default(0);
            $table->integer('count_like')->default(0);
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
		Schema::drop('albums');
	}
}
