<?php

namespace Database\Seeders;

use App\Models\PostType;
use Illuminate\Database\Seeder;

class PostTypeSeeder extends Seeder
{
    public function run(): void
    {
        $postTypes = config('post_type.post_types');

        PostType::insert($postTypes);
    }
}
