<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        //شروط في حال حدا بدو يفوت عرابط مو مسموح يفوت عليه
        if (!$request->expectsJson()) {
            if (Request::is(app()->getLocale() . '/student/Dashboard')) {
                return route('selection');
            }
            elseif(Request::is(app()->getLocale() . '/teacher/Dashboard')) {
                return route('selection');
            }
            elseif(Request::is(app()->getLocale() . '/parent/Dashboard')) {
                return route('selection');
            }
            elseif(Request::is(app()->getLocale() . '/Dashboard')) {
                return route('selection');
            }
            else {
                return route('selection');
            }
        }
    }
}
