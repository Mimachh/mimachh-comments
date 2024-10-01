<?php
use Illuminate\Support\Facades\Route;
use Mimachh\Comments\Http\Controllers\CommentController;


Route::controller(CommentController::class)->prefix('comment')->name('comment.')->group(function () {
    Route::post('create', 'create')->name('create');
    Route::put('update', 'update')->name('update');
    Route::delete('delete', 'delete')->name('delete');


    // get one
    // get with pagination
    // get child with pagination
    // get count of root comments
    // get count of children of this comment
    // get count of all comments
});
