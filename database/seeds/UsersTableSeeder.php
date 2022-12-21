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
            'name' => 'Mr: Admin',
            'username' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('111111'),
        ]);
        DB::table('users')->insert([
            'role_id' => '2',
            'name' => 'Mr: Author',
            'username' => 'Author',
            'email' => 'author@gmail.com',
            'password' => bcrypt('111111'),
        ]);
    }
}
