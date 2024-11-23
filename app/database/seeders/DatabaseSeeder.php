<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table("users")->insert([
            [
                "name" => "Виктор",
                "email" => "viktor@gmail.com",
                "is_admin" => false,
                "password" => \Hash::make("123"),
            ],
            [
                "name" => "Николай",
                "email" => "nikolay@gmail.com",
                "is_admin" => false,
                "password" => \Hash::make("123"),
            ],
            [
                "name" => "Дмитрий",
                "email" => "dmitry@gmail.com",
                "is_admin" => true,
                "password" => \Hash::make("123"),
            ]
        ]);
    }
}
