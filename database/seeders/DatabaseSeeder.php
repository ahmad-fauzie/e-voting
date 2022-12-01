<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $user = [
            [
                'name'      =>  'admin',
                'email'     =>  'admin@gmail.com',
                'nis'       =>  '',
                'level'     =>  'admin',
                'password'  =>  bcrypt('123'),
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
