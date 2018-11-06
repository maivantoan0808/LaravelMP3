<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'Unknown',
            'slug' => 'unknown',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('categories')->insert([
            'name' => 'Nhạc trẻ',
            'slug' => 'nhac-tre',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('categories')->insert([
            'name' => 'Nhạc vàng',
            'slug' => 'nhac-vang',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('categories')->insert([
            'name' => 'Nhạc đỏ',
            'slug' => 'nhac-do',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
