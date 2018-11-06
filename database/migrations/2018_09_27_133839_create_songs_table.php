<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateSongsTable.
 */
class CreateSongsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('songs', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->string('name');
            $table->string('slug');
            $table->string('normal_url');
            $table->string('vip_url')->nullable();
            $table->string('image')->nullable();
            $table->longText('lyrics')->nullable();
            $table->integer('count_listen')->default(0);
            $table->integer('count_download')->default(0);
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
		Schema::drop('songs');
	}
}
