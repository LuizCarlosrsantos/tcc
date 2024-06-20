<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new \App\Models\User();

        if (!$user->where('email', 'admin@localhost')->exists()) {
            $user->name = 'Admin';
            $user->email = 'admin@localhost';
            $user->password = bcrypt('admin');
            $user->assignRole('admin');

            $user->save();
        }
    }
}
