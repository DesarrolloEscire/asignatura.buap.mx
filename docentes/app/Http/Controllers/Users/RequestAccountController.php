<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Mail\UserRegisteredMail;
use App\Models\Teacher;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class RequestAccountController extends Controller
{
    public function __invoke(Request $request)
    {

        $email = "$request->email@correo.buap.mx";
        // Teacher exists/create process
        if (Teacher::where('identifier', $request->identifier)->exists()) {
            Alert::error('El identificador ya se encuentra en la base de datos de docentes');
            return redirect()->back();
        }
        else{
            $teacher = new Teacher();
            $teacher->name = strtoupper($request->name);
            $teacher->identifier = $request->identifier;
            $teacher->email = $email;

            $teacher->save();
        }

        // User verified exists
        if (User::whereIdentifier($request->identifier)->verified()->exists()) {
            Alert::error('Ya se encuentra un usuario registrado con el identificador solicitado');
            return redirect()->back();
        }

        // Email duplicated validation
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Alert::error("Error", "El correo electrónico ingresado: $email no es un correo válido. Por favor, vuelve a intentarlo");
            return redirect()->back();
        }

        // User not verified exists
        if (User::whereNotIdentifier($request->identifier)->whereEmail($email)->exists()) {
            Alert::error('Ya existe una cuenta con el correo ingresado.');
            return redirect()->back();
        }

        // Generate random password
        $password = Str::random();
        // Generate/Update user
        $user = User::firstOrCreate([
            'identifier' => $request->identifier
        ], [
            'name' => strtoupper($request->name),
            'email' => $email,
            'password' => bcrypt($password),
        ])->assignRole(Role::TEACHER_ROLE);

        $user->academicUnits()->sync([$request->academic_unit_id]);

        Mail::to($user->email)
            ->send(new UserRegisteredMail($user, $password));

        Alert::success('El usuario ha sido registrado correctamente.', 'por favor, revisa tu bandeja de correos electronicos para verificar tu cuenta');
        return redirect()->route('login');
    }
}
