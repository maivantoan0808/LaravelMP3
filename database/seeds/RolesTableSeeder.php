<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'Admin',
            'slug' => 'admin',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('roles')->insert([
            'name' => 'Listener',
            'slug' => 'listener',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('roles')->insert([
            'name' => 'Singer',
            'slug' => 'singer',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('roles')->insert([
            'name' => 'Listener Request Singer',
            'slug' => 'listener-request-singer',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

    }
}
