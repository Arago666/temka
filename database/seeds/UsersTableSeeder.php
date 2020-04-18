<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user[]=[
            'name'    => 'Artem',
            'email'       => 'art.manaenkov@gmail.com',
            'password'   => '12345678',

        ];



        \DB::table('users')->insert($user);
    }
}
