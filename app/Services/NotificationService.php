<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Services\Contracts\NotificationServiceContract;

class NotificationService implements NotificationServiceContract
{
    public function isNotified()
    {
        try {            
            $notification = Http::get('https://run.mocky.io/v3/b19f7b9f-9cbf-4fc6-ad22-dc30601aec04');
            if (isset($notification['message']) && $notification['message'] === 'Enviado') {
                return true;
            }
            return false;
        }
        catch(\Exception $e){
            return false;
        }
    }
}