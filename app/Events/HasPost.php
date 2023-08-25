<?php

namespace App\Events;

use App\Models\Post;

interface HasPost
{
    public function getPost(): Post;
}
