<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Organisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AgentOrganisationCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Retrieve the organization name from the URL segment
        $organisationName = $request->route('organisation');

        $organisationName = join(" ", explode("-", $organisationName));

        $user = Auth::user();

        if(!$user){
            return redirect()->route("auth.login");
        }

        $user_id = $user->id;

        $organisation = Organisation::whereHas('userOrganisations', function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        })
        ->where('name', 'like', '%' . $organisationName . '%')
        ->first();

        // Confirm if this user belongs to an organisation
        if (!$organisation || $user->organisations->first()->pivot->is_admin === 1) {
            return redirect()->route("auth.login");
        }

        // Store the organisation and user details in the request for later use
        $request->merge(['organisation' => $organisation, 'activeUser' => $user]);


        return $next($request);
    }
}
