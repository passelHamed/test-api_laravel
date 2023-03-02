<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subscribe extends Model
{
    use HasFactory;

    protected $table = 'subscribers';

    protected $fillable = [
        'email',
        'website_id',
    ];

    public function website(): BelongsTo
    {
        return $this->belongsTo(
            website::class,
        );
    }

    public function sendPosts(): BelongsToMany
    {
        return $this->belongsToMany(
            Post::class,
            'send_posts',
            'subscriber_id',
        )->withPivot(
            'last_read',
        );
    }
}
