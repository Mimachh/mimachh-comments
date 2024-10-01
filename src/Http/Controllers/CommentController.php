<?php

namespace Mimachh\Comments\Http\Controllers;
use Illuminate\Routing\Controller;
use Mimachh\Comments\Http\Requests\DeleteCommentRequest;
use Mimachh\Comments\Http\Requests\StoreCommentRequest;
use Mimachh\Comments\Http\Requests\UpdateCommentRequest;

class CommentController extends Controller 
{
    public function create(StoreCommentRequest $request) {
        $data = $request->validated();
       
        $model = $data['commentable_id'] ? $this->getModel($data['commentable_type'], $data['commentable_id']) : null;

        if (!$model) {
            return response()->json(['error' => 'Model not found.'], 404);
        }

        try {
            $model->addComment(
                $data['user_id'],
                $data['content'],
                $data['parent_comment_id'] ?? null,
                $data['commentable_id'],
                $data['commentable_type']
            );
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
       
        return response()->json(['message' => 'Comment added successfully']);
    }

    public function update(UpdateCommentRequest $data) {
        $model = $data['commentable_id'] ? $this->getModel($data['commentable_type'], $data['commentable_id']) : null;

        if (!$model) {
            return response()->json(['error' => 'Model not found.'], 404);
        }

        try {
            $model->editComment($data['comment_id'], $data['content']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
        return response()->json(['message' => 'Comment updated successfully']);
    }


    public function delete(DeleteCommentRequest $data) {
        $model = $data['commentable_id'] ? $this->getModel($data['commentable_type'], $data['commentable_id']) : null;

        if (!$model) {
            return response()->json(['error' => 'Model not found.'], 404);
        }

        $model->deleteComment($data['comment_id']);

        return response()->json(['message' => 'Comment deleted successfully']);
    }

    protected function getModel($type, $id)
    {
        $modelClass = 'App\\Models\\' . ucfirst($type);

    
        if (!class_exists($modelClass)) {
            return null;
        }

        return $modelClass::find($id);
    }
}