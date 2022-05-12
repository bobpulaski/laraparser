<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UpdateLeftMenu
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
        $projectsMenuItems = DB::table('projects')->select('id', 'name')->where('user_id', Auth::id())->get();
        $chaptersMenuItems = DB::table ('chapters')->select ('id', 'project_id', 'user_id', 'name')->where('user_id', Auth::id())->get();

        $request->attributes->add(['projectsMenuItems' => $projectsMenuItems, 'chaptersMenuItems' => $chaptersMenuItems]);

        return $next($request);
    }
}
