<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\DB;

class CheckReferral
{
    public function handle($request, Closure $next)
    {

        if ($request->hasCookie('referral')) {

            return $next($request);
        }

        if (($ref = $request->query('ref')) && app(config('referral.user_model', 'App\User'))->referralExists($ref)) {

            $user = User::where('affiliate_id',$ref)->first();
            $user->referrals_number +=1;
            DB::transaction(function ()use($user){
                $user->save();
            });
            return redirect($request->fullUrl())->withCookie(cookie()->forever('referral', $ref));
        }

        return $next($request);
    }
}
