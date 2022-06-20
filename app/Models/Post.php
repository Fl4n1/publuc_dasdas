<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;


    protected $fillable = ['title', 'slug', 'description', 'img_prev', 'image', 'user_id'];

    // We have post and it belongsTo a user

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // We have a post and it morphMany a comments
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }
}
