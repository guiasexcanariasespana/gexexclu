<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ComproPago
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
        if (!$request->user()->hasRole('Admin')) {
            if (!$request->user()->isVerificado()) {
                
                if(!$request->user()->compro_primero()){
                    return redirect()->route('comprar_anuncio_inicio', $request->user());
                }
                
            }
        }else{
            return redirect()->route('admin.anuncios.index');
        }    
        return $next($request);
    }
}
