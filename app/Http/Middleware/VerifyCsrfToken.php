<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     * 
     * @var array<int, string>
     */


     /** Examples
     * Route::post('users/valid','UsersController@valid');
     * protected $except = ['users/valid']; only 1
     * protected $except = ['users/valid','users/valid1'];more than one
     * protected $except = ['users/*','*users/valid','*users/valid*']; ex : users/name ; users/email
     */
    protected $except = [
        //
    ];
}
