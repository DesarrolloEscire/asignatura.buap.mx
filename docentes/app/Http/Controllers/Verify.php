<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class Verify extends Controller
{
    public function __invoke(User $user)
    {
        $user->verify();
        Auth::login($user);

        Alert::success('Cuenta verificada');
        return redirect()->route('login');
    }
}
