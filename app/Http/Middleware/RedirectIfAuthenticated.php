<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        $currentPath = $request->path();

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // return redirect(RouteServiceProvider::HOME);
                $user = Auth::user();

                // dd("User is in session [Middleware] RedirectIfAuthenticated");

                if($user->is_super_admin){
                    // Super Admin
                    return redirect()->to("super-admin.dashboard");
                }elseif(!$user->organisations->first() && $currentPath !== "account/setup"){
                    // New Organisation Admin
                    return redirect()->to("/account/setup/");
                }elseif($user->organisations->first()?->pivot->is_admin ?? false){
                    $admin_organisation_name = strtolower(join("-", explode(" ", $user->organisations->first()->name)));
                    // Organisation Admin
                    $url = route('org-admin.dashboard', ['organisation' => $admin_organisation_name]);

                    return redirect()->to($url);
                }elseif($user->organisations->first()?->pivot->is_admin === "0" ?? false){
                    // Staff/Agent
                    $staff_organisation_name = strtolower(join("-", explode(" ", $user->organisations->first()->name)));

                    $url = route('org-agent.dashboard', ['organisation' => $staff_organisation_name]);
                    return redirect()->to("/{{$staff_organisation_name}}/agent/dashboard");
                }else{
                    // Pass through if all fails
                }
            }else{
                if($currentPath === "account/setup"){
                    return redirect()->route("auth.login");
                }
            }
        }

        return $next($request);
    }
}
