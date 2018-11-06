<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreatePlaylistsTable.
 */
class CreatePlaylistsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('playlists', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('name');
            $table->string('slug');
            $table->string('image')->default('default.jpg');
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
		Schema::drop('playlists');
	}
}
