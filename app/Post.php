<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'value', 'user_id', 'published'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
