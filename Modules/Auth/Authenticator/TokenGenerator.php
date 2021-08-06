<?php

namespace Modules\Auth\Authenticator;

use Illuminate\Support\Str;

class TokenGenerator
{
    public function generateToken()
    {
        return Str::random(60);
    }
}
