<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class PermissionMiddleware
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next): Response
  {
    $user = auth()->user();
    if (! $user) {
      return $next($request);
    }
    $roles            = Role::with('permissions')->get();
    $permissionsArray = [];

    foreach ($roles as $role) {
      foreach ($role->permissions as $permissions) {
        $permissionsArray[$permissions->title][] = $role->id;
      }
    }
    foreach ($permissionsArray as $title => $roles) {
      Gate::define($title, function ($user) use ($roles) {
        return count(array_intersect($user->roles->pluck('id')->toArray(), $roles)) > 0;
      });
    }
    return $next($request);
  }
}
