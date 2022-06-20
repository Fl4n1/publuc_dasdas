<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * Связь модели Comment с моделью Post, позволяет получить
     * пост, которому принадлежит комментарий
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Связь модели Comment с моделью Auth, позволяет получить
     * пользователя, который оставил комментарий
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
