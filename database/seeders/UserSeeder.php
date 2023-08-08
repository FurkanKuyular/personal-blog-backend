<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $user = new User();

        $user->email = env('USER_EMAIL');
        $user->password = env('USER_PASSWORD');

        $user->save();
    }
}
