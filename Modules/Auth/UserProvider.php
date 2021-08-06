<?php

namespace Modules\Auth;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Modules\User\Models\User;

class UserProvider
{
    /**
     * You may also accept user's phone number to send the code via sms.
     *
     * @param  string  $email
     *
     * @return Builder|Model|object|null
     */
    public function getUserByEmail(string $email)
    {
        return User::query()
            ->where('email', $email)
            ->first();
    }

    /**
     * @param $userPass
     * @param $inputPassword
     *
     * @return bool
     */
    public function checkUserPassword($userPass, $inputPassword): bool
    {
        return Hash::check($inputPassword, $userPass);
    }

    /**
     * check if the user is a manager or not
     *
     * @param $user
     *
     * @return bool
     */
    public function isManager($user): bool
    {
        return $user->isManager();
    }

    public function saveToken($user, $token)
    {
        $user->fill(['api_token' => $token]);
        return $user->save();
    }

    /**
     * CURRENTLY IS DEMO
     *
     * @param $uid
     *
     * @return bool
     */
    public function isBanned($uid): bool
    {
        return FALSE;
    }

}
