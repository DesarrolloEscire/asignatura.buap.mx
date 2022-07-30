<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Mail\UserRegisteredMail;
use App\Models\Role;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class RegisterAccountController extends Controller
{
    public function __invoke(Request $request)
    {
        $student = Student::whereIdentifier($request->identifier)->first();

        if (!$student) {
            Alert::error('No existe algún usuario con el identificador solicitado.', 'solicítalo a tu Unidad Académica');
            return redirect()->back();
        }

        if (User::whereIdentifier($request->identifier)->verified()->exists()) {
            Alert::error('Ya existe una cuenta con el identificador solicitado.');
            return redirect()->back();
        }

        if (User::whereNotIdentifier($request->identifier)->whereEmail($student->email)->exists()) {
            Alert::error("Ya existe una cuenta con el correo: $student->email ingresado.");
            return redirect()->back();
        }

        $password = Str::random();

        $user = User::updateOrCreate([
            'identifier' => $student->identifier
        ], [
            'name' => strtoupper($student->name),
            'password' => bcrypt($password),
            'email' => $student->email,
        ])->assignRole(Role::STUDENT_ROLE);

        $user->academicUnits()
            ->sync($student->academicUnits()->first()->id ?? []);

        Mail::to($student->email)
            ->send(new UserRegisteredMail($user, $password));

        Alert::success('¡Usuario registrado!', 'Se ha enviado un correo electrónico para validar tu registro');
        return redirect()->route('login');
    }
}
