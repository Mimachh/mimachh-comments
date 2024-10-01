<?php

return [

    /*
        |--------------------------------------------------------------------------
        | Enable Comments
        |--------------------------------------------------------------------------
        |
        | This option controls whether the Comments is enabled for the application.
        | 
        */
    'enable' => env('COMMENTS_ENABLE', false),

    // TODO: NOT DID YET
    /*
        |--------------------------------------------------------------------------
        | Accept Comments
        |--------------------------------------------------------------------------
        |
        | This option controls if the comments are accepted by default or need to be approved by a role.
        | 'true' means comments are accepted by default.
        | 
        */
    'accept' => env('COMMENTS_ACCEPT', true),

    /*
        |--------------------------------------------------------------------------
        | Comments Response
        |--------------------------------------------------------------------------
        |
        | This option controls if comments can have response by users. Default is false.
        | Another option give access to a certain role to override this option and answer to comments.
        */
    'response' => env('COMMENTS_RESPONSE', false),

    /*
        |--------------------------------------------------------------------------
        | Comments Edit
        |--------------------------------------------------------------------------
        |
        | This option controls if comments can be edited. Default is false.
        */
    'edit' => env('COMMENTS_EDIT', false),


    /*
        |--------------------------------------------------------------------------
        | VIP Role
        |--------------------------------------------------------------------------
        |
        | This option controls the role that can answer to comments if the response option is false.
        | Adding roles here also give you the ability to add custom style to their comments.
        | This package works well with the mimachh-guardians package, but you can use your own roles. If so, make sure to precise relation type below.
        */
    'vip' => [],

    /*
        |--------------------------------------------------------------------------
        | Role relation type
        |--------------------------------------------------------------------------
        |
        | This option allow package to know what type of relation your user->role is
        | Allowed values are : 'pivot'
        */
    // FIXME: Add the role relation type
    // je veux pouvoir faire if $user->hasRole('machin') alors


    // TODO: NOT IMPLEMENTED YET
    /*
        |--------------------------------------------------------------------------
        | Auth config
        |--------------------------------------------------------------------------
        |
        | This option allow you to specify if user need to be authenticated to comment.
        */
    'auth' => env('COMMENTS_AUTH', false),


];
