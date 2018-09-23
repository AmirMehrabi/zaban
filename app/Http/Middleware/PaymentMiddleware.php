<?php

namespace App\Http\Middleware;

use Closure;
use App\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PaymentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      if (Auth::user()) {
        $paid = Payment::where('user_id', Auth::user()->id)->where('activated', 1)->orderBy('created_at', 'desc')->first();
        if (!is_null($paid)) {
          $expiration_date = Carbon::parse($paid->payment_date)->addDays($paid->duration);
          if (Carbon::now() > $expiration_date) {
            Auth::user()->current_date = Carbon::now();
            Auth::user()->expiration_date = $expiration_date;
            Auth::user()->paid = 0;
            /*اشتراک به اتمام رسیده*/
          }
          elseif (Carbon::now() < $expiration_date) {
            Auth::user()->current_date = Carbon::now();
            Auth::user()->expiration_date = $expiration_date;
            Auth::user()->remaining = Auth::user()->expiration_date->diffInDays(Auth::user()->current_date);
            Auth::user()->paid = 1;
            /*دارای اشتراک*/
          }
        }
        elseif (is_null($paid)) {
          Auth::user()->paid = 2;
          /*تا کنون اشتراک خریداری نشده*/
        }
      }


        return $next($request);
    }
}
