<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationshipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('songs', function (Blueprint $table) {
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
        });

        Schema::table('albums', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('song_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('album_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });

        Schema::table('follows', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });

        Schema::table('playlists', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });

        Schema::table('likes', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('song_id')
                ->references('id')
                ->on('songs')
                ->onDelete('cascade');
            $table->foreign('album_id')
                ->references('id')
                ->on('albums')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relationships');
    }
}
