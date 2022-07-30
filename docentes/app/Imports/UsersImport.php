<?php

namespace App\Imports;

use App\Models\AcademicUnit;
use App\Models\EducationalProgram;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        $collection->each(function ($row) {


            $row = new UserRow($row);

            try {

                $user = User::firstWhere('identifier', $row->identifier()->value());

                if (!$user && !$row->password()) {
                    $userName = $row->name();
                    Log::channel('usersimport')->error("el usuario $userName no pudo ser creado, ya que no existe en la base de datos y no se le asignó una contraseña");
                    return;
                }

                if ($row->password()) {
                    $user->password = bcrypt($row->password());
                    $user->save();
                }

                if (!$user) {
                    $user = $this->_createUser($row);
                }
            } catch (\Throwable $th) {
                $message = $th->getMessage();
                $userName = $row->name();
                Log::channel('usersimport')->error("el usuario $userName no pudo ser creado. $message");
                return;
            }

            Log::channel('usersimport')->info("usuario creado o actualizado: $user->name");

            $roleName = $row->roleName();

            if ($roleName == 'coordinador') {
                $user->update(['password' => bcrypt($row->password())]);
            }

            $user->verify();

            $user->syncRoles($row->roleName());

            Log::channel('usersimport')->info("rol $roleName asignado a $user->name");

            $academicUnitKey = $row
                ->academicUnitKey();

            $academicUnitName = $row
                ->academicUnitName();

            if ($academicUnitKey) {
                $academicUnit = AcademicUnit::firstOrCreate([
                    'key' => $academicUnitKey
                ], [
                    'name' => $academicUnitName
                ]);
            }

            if (!isset($academicUnit) && $row->academicUnitName()) {
                $academicUnit = AcademicUnit::where('name', $academicUnitName)->first();
            }

            if (!isset($academicUnit) || !$academicUnit) {
                Log::channel("custom")
                    ->warning("No existe la Unidad Académica con la clave: $academicUnitKey or $academicUnitName.");
                return;
            }

            $user->academicUnits()
                ->sync($academicUnit->id);

            $educationalProgramKey = $row
                ->educationalProgramKey();

            if (!$educationalProgramKey) {
                Log::channel('usersimport')
                    ->warning("No se asignó programa educativo al usuario $user->name.");
                return;
            }

            $educationalProgram = EducationalProgram::where('key', $educationalProgramKey)->first();

            if (!$educationalProgram) {
                Log::channel('usersimport')
                    ->warning("No existe el programa de asingatura con la clave $educationalProgramKey");
                return;
            }
        });
    }

    private function _createUser(UserRow $row)
    {
        $user = User::create([
            'identifier' => $row->identifier()->value(),
            'name' => $row->name(),
            'email' => $row->email(),
            'password' => bcrypt($row->password())
        ]);

        $user->password = bcrypt($row->password());
        $user->save();

        return $user;
    }
}

class UserRow
{

    private $row;

    public function __construct($row)
    {
        $this->row = $row;
    }

    public function name(): string
    {
        return $this->row["nombre"];
    }

    public function email(): string
    {
        return $this->row['correo'];
    }

    public function identifier(): Identifer
    {
        return new Identifer($this->row['id']);
    }

    public function password(): ?string
    {
        if (!isset($this->row['contrasena'])) {
            return null;
        }

        return $this->row['contrasena'];
    }

    public function educationalProgramKey(): ?string
    {
        return $this->row['cveplan'] ?? null;
    }

    public function academicUnitKey(): ?string
    {
        return $this->row['clavedep'] ?? null;
    }

    public function academicUnitName(): ?string
    {
        return $this->row['ua'] ?? null;
    }

    public function roleName(): string
    {
        $columnRoleName = $this->row['cargo'];

        if ($columnRoleName == 'Director/a') {
            return Role::DIRECTOR_ROLE;
        }

        if ($columnRoleName == 'Secretario Académico') {
            return Role::SECRETARY_ROLE;
        }

        if ($columnRoleName == 'coordinador') {
            return Role::COORDINATOR_ROLE;
        }

        throw new Exception("the role $columnRoleName does not exists");
    }
}

class Identifer
{
    private $_identifier;

    public function __construct(string $identifier)
    {
        $this->_validate($identifier);
        $this->_identifier = $identifier;
    }

    private function _validate(string $identifier)
    {
        if (!ctype_alnum($identifier)) {
            throw new InvalidArgumentException("the identifier $identifier is not valid");
        }
    }

    public function value()
    {
        return $this->_identifier;
    }
}
