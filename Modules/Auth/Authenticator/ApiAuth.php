<?php

namespace Modules\Auth\Authenticator;

use Illuminate\Support\Facades\Auth;

class ApiAuth
{
    public function check()
    {
        return Auth::guard('api')->check();
    }

    public function getUser()
    {
        return Auth::guard('api')->user();
    }


    public function getUserId()
    {
        return Auth::guard('api')->id();
    }


}
