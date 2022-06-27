<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;

class GetChapterIdMW
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        //$request->session()->get('ChapterIdForAppServiceProvider');
        //Session::get ('ChapterIdForAppServiceProvider');


        //$pizda = $request->attributes->add(['ChapterIdForAppServiceProvider' => Session::get ('ChapterIdForAppServiceProvider')]);
        $pizda = Session::get ('ChapterIdForAppServiceProvider');
        Session::put ('pizda', $pizda);

        return $next($request);
    }
}
