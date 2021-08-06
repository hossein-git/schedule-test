<?php

namespace Modules\Auth\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Auth\Facades\AuthFacade;
use Modules\Auth\Facades\TokenGeneratorFacade;
use Modules\Auth\Facades\UserProviderFacade;
use Modules\Auth\Http\Requests\LoginRequest;
use Modules\Base\Http\ResponderFacade;

class SampleAuthController extends Controller
{

    public function login(LoginRequest $request)
    {
        $input = $request->validated();

        // find user row in DB or Fail
        $user = UserProviderFacade::getUserByEmail($input['email']);

        if (!$user) {
            return ResponderFacade::userNotFound();
        }
        //check the password
        if (!UserProviderFacade::checkUserPassword($user->password, $input['password'])) {
            return ResponderFacade::userNotFound();
        }

        // 1. stop block users
        //this is an emaple
//        if (UserProviderFacade::isBanned($user->id)) {
//            return ResponderFacade::blockedUser();
//        }

        //2 generate token
        $token = TokenGeneratorFacade::generateToken();

        //3 save token
        UserProviderFacade::saveToken($user, $token);

        // 4 check the role of user and pass response
        if (UserProviderFacade::isManager($user)) {
            return ResponderFacade::loggedIn('admin', $user->toArray());
        }
        return ResponderFacade::loggedIn('worker', $user->toArray());
    }


}
