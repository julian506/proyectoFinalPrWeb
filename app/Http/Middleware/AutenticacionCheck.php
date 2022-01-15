<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AutenticacionCheck
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
        // Si no ha iniciado sesión y quiere entrar a alguna vista que no sea el login, la ventana de registro o el index normal...
        //Se redirige al usuario a la vista de login con un mensaje de error
        if(!session()->has('LoggedUser') && ($request->path() != 'auth/login' && $request->path() != 'auth/register' && $request->path() != '/')){
            return redirect('auth/login')->with('fail', 'Debes haber iniciado sesión para poder acceder');
        }
        // Si ya se ha iniciado sesión y quiere ir al login, al register o al index inicial...
        //Se deja al usuario en la misma página en que estaba
        if(session()->has('LoggedUser') && ($request->path() == 'auth/login' || $request->path() == 'auth/register' || $request->path() == '/')){
            return back();
        }
         // Si el administrador está loggeado y desea ir a alguna de las rutas desprotegidas para los usuarios, automáticamente se cerrará la sesión de administrador
         if(session()->has('LoggedAdmin') && ($request->path() == 'auth/login' || $request->path() == 'auth/register' || $request->path() == '/')){
            echo "<script> alert('Se cerrará su sesión como administrador') </script>";
            session()->pull('LoggedAdmin');
        }
        // Elimino el caché para prevenir vulneraciones
        return $next($request)  ->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')
                                ->header('Pragma', 'no-cache')
                                ->header('Expires', 'Sat 01 Jan 1990 00:00:00 GMT');
    }
}
