<?php

use Illuminate\Database\Seeder;
use App\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'photo' => 'no-img.jpg',
            'password' => bcrypt('123456'),
            'is_admin' => 1,
        ]);
    }
}
