<?php

namespace App\Src\Users\Application;

use App\Mail\UserInvitationMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

/**
 * When a user is registered he/she is invited to the platform
 * 
 */
class InviteNewUser
{

    /**
     * 
     * 
     * @param string $email 
     * @param string $names
     * @return void
     */
    public function handle(string $email, string $names)
    {
        $user = User::create([
            'email' => $email,
            'name' => $names,
        ]);

        Mail::to($user->email)
            ->send(new UserInvitationMail($user));
    }
}
