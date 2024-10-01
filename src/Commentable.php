<?php

namespace Mimachh\Comments;

use Mimachh\Comments\Models\Comment;

trait Commentable
{
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }


    public function addComment(
        $userId,
        $content,
        $parentCommentId = null,
        $commentableId,
        $commentableType
    ) {
        
        if(!config('mimachh-comments.enable')) {
            throw new \Exception('Les commentaires sont désactivés.');
        }
        
        if($parentCommentId && !config('mimachh-comments.response')) {
            throw new \Exception('Les réponses aux commentaires sont désactivées.');
        }

        $this->validateCommentData($content, $parentCommentId);

        $commentableId = $commentableId ?? $this->id;
        $commentableType = $commentableType ?? get_class($this);

        $this->comments()->create([
            'user_id' => $userId,
            'content' => $content,
            'parent_comment_id' => $parentCommentId ?? null,
            'commentable_id' => $commentableId,
            'commentable_type' => $commentableType,
        ]);
    }

    public function deleteComment($commentId)
    {
        $comment = $this->comments()->find($commentId);

        if ($comment) {
            $comment->delete();
        }
    }

    public function editComment($commentId, $content)
    {
        if(!config('mimachh-comments.enable')) {
            throw new \Exception('Les commentaires sont désactivés.');
        }

        if(!config('mimachh-comments.edit')) {
            throw new \Exception('La modification des commentaires est désactivée.');
        }

        $comment = $this->comments()->find($commentId);

        if ($comment) {
            $this->validateCommentData($content);
            $comment->update(['content' => $content]);
        }
    }

    public function commentCount()
    {
        return $this->comments()->count();
    }


    private function validateCommentData($content, $parentCommentId = null)
    {
        if (empty($content)) {
            throw new \Exception('Le contenu est requis.');
        }

        if ($parentCommentId && !Comment::find($parentCommentId)) {
            throw new \Exception('Le commentaire parent est introuvable.');
        }
    }
}
