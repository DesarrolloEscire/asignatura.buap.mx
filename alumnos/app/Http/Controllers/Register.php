<?php

namespace App\Http\Controllers;

use App\Mail\UserInvitationMail;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class Register extends Controller
{
    public function __invoke(Request $request)
    {

        $teacher = Teacher::whereIdentifier($request->identifier)->first();

        if (!$teacher) {
            Alert::error('El ID de docente ingresado no se encuentra en nuestros registros');
            return redirect()->back();
        }

        if (User::whereIdentifier($teacher->identifier)->verified()->exists()) {
            Alert::error('El usuario ya se encuentra registrado en la plataforma');
            return redirect()->back();
        }

        // if ($request->password != $request->repeated_password) {
        //     Alert::error('Las contraseñas ingresadas no son iguales');
        //     return redirect()->back();
        // }

        $plainPassword = $this->generateRandomPassword();

        $user = User::updateOrCreate([
            'identifier' => $teacher->identifier
        ], [
            'name' => strtoupper($teacher->name),
            'email' => $teacher->email,
            'password' => bcrypt($plainPassword)
        ]);

        Mail::to($teacher->email)
            ->send(new UserInvitationMail($user, $plainPassword));

        Alert::success(
            'Usuario registrado',
            'Se le envió su contraseña a su correo institucional, en caso de no tener correo institucional es OBLIGATORIO tramitarlo, ya que es el único medio para ingresar al ecosistema'
        );
        return redirect()->route('login');
    }

    private function generateRandomPassword($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
