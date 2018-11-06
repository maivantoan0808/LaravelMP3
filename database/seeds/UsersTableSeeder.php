<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'role_id' => '1',
            'name' => 'MVT.Admin',
            'username' => 'admin',
            'email' => 'admin@mp3.com',
            'password' => bcrypt('admin123'),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('users')->insert([
            'role_id' => '2',
            'name' => 'MVT.Listener',
            'username' => 'listenter',
            'email' => 'listener@mp3.com',
            'password' => bcrypt('listener123'),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        factory(App\Models\User::class, 20)->create();
    }
}
