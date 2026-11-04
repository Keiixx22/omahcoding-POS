<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/** Semua tampilan memakai bahasa default aplikasi (id). Pilihan bahasa per bisnis sudah dihapus. */
class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        app()->setLocale(config('app.locale'));

        return $next($request);
    }
}
