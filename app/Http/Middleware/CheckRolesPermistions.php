<?php

namespace App\Http\Middleware;

use App\Exceptions\ApiException;
use App\Models\Role;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class CheckRolesPermistions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        if (! $this->hasRole($request->user(), $role)) {
            throw new ApiException('У вас нет прав', 403);
        }
        return $next($request);
    }

    private function hasRole(User $user, string $role): bool
    {
        $roles = $user->roles()->pluck('alias')->toArray();
        return in_array($role, $roles);
    }
}
