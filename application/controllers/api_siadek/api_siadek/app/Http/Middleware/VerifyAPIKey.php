<?php

namespace App\Http\Middleware;

use Closure;

class VerifyAPIKey
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
        // You can check API key database too
        // $generate_api_key = bin2hex(openssl_random_pseudo_bytes(8));
        $api_keys = array('Kominfo', 'bantaeng');

        if ($request->header('APIKEY')) {
            $api_key = $request->header('APIKEY');

            // check token
            if (in_array($api_key, $api_keys)) {
                return $next($request);
            } else {
                return response()->json([
                    'results' => 'API key Tidak Sesuai',
                ]);
            }
        }

        return response()->json([
            'results' => 'APIKEY Gagal',
        ]);
    }
}
