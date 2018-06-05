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
            'name' => 'antoine',
            'email' => 'antoine.gillot60@gmail.com',
            'password' => bcrypt('antoine'),
        ]);
        factory(App\User::class, 30)->create();
    }
}
