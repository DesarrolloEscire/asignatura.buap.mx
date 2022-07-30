<?php

namespace App\Http\Controllers\Plannings\Users;

use App\Http\Controllers\Controller;
use App\Models\Planning;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class Detach extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Planning $planning, User $user)
    {
        $planning->users()->detach($user->id);

        Alert::success("El usuario ha sido desvinculado exitosamente.");

        return redirect()->back();
    }
}
