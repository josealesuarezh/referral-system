<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $email = 'dev@mobilerider.com';
        $password = Hash::make('snowflake');

        $filters = [
            ['email', $email],
        ];

        if (!DB::table('users')->where($filters)->exists()) {
            DB::table('users')->insert([
                'name' => 'dev',
                'email' => $email,
                'password' => $password,
                'affiliate_id' => '4qOxx'
            ]);
        }
    }
}
