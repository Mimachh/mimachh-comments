<?php

namespace Mimachh\Comments\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model 
{
    
    // je dois pouvoir compter le nombre de commentaire d'un post (ou autre model)
    // je dois pouvoir compter le nombre de commentaire d'un commentaire
    // je dois pouvoir compter le nombre de commentaire d'un utilisateur

    protected $fillable = ['user_id', 'commentable_id', 'commentable_type', 'parent_comment_id', 'content'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function commentable()
    {
        return $this->morphTo();
    }

    public function parentComment()
    {
        return $this->belongsTo(Comment::class, 'parent_comment_id');
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_comment_id');
    }

    protected static function booted()
    {
        static::deleting(function ($comment) {
            $comment->replies()->each(function ($child) {
                $child->delete();
            });
        });
    }
    
}