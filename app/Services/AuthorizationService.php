<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Services\Contracts\AuthorizationServiceContract;

class AuthorizationService implements AuthorizationServiceContract
{

    public function isAuthorized()
    {
        try {
            $authorization = Http::get('https://run.mocky.io/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6');
            if (isset($authorization['message']) && $authorization['message'] === 'Autorizado') {
                return true;
            }
            return false;
        }
        catch(\Exception $e){
            return $e;
        }
    }
}