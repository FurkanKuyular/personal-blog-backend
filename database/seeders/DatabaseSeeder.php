<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(SkillSeeder::class);
        $this->call(ExpertiseSeeder::class);
        $this->call(ReferenceSeeder::class);
        $this->call(PostTypeSeeder::class);
        $this->call(PostSeeder::class);
    }
}
