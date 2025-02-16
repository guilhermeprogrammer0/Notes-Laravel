<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeader extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(
            [
                'username'=>'username@gmail.com',
                'password'=> bcrypt('abc123'),
                'created_at'=> date('Y-m-d H:i:s')
            ],
            [
                'username'=>'user2name@gmail.com',
                'password'=> bcrypt('abc123'),
                'created_at'=> date('Y-m-d H:i:s')
            ],
            [
                'username'=>'user3name@gmail.com',
                'password'=> bcrypt('abc123'),
                'created_at'=> date('Y-m-d H:i:s')
            ]
            );
    }
}
