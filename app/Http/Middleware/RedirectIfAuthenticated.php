<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next )
    {
        //[middleware] يستدعا هذا الملف عند استخدام
        //يتم التحقق في حال كان المستخدم  له حق الدخول
        //you can get these [web,student,teacher,parent]
        //from config.auth [guards]
        if (auth('web')->check()) {
            return redirect(RouteServiceProvider::HOME);
        }
        if (auth('student')->check()) {
            return redirect(RouteServiceProvider::STUDENT);
        }
        if (auth('teacher')->check()) {
            return redirect(RouteServiceProvider::TEACHER);
        }
        if (auth('parent')->check()) {
            return redirect(RouteServiceProvider::PARENTS);
        }

        return $next($request);
        //في حال لم يكن المستخدم لديه حق الوصول مثلا
        //ف [student]بنسخ رابط خاص بال[admin] قام احد  حسابو
        //منحط الشروط [middlware->authenticate] منروح ع
    }
}
