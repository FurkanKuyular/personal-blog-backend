<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'title',
        'body',
        'post_link',
        'post_image_html',
        'user_id',
        'post_type_id',
        'is_active',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function postType(): BelongsTo
    {
        return $this->belongsTo(PostType::class);
    }
}
