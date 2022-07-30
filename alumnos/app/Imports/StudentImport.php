<?php

namespace App\Imports;

use App\Models\AcademicUnit;
use App\Models\Student;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentImport implements ToCollection, WithHeadingRow, WithChunkReading
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $sutdentRow) {
            $row = new Row($sutdentRow);

            $name = $row->name();

            if (!$row->identifier()) {
                Log::channel('studentsimport')->error("el estudiante $name no cuenta con identificador");
                continue;
            }

            $student = Student::updateOrCreate([
                'identifier' => $row->identifier()
            ], [
                'name' => $name,
                'email' => $row->email()
            ]);

            Log::channel('studentsimport')->info("el estudiante $name fué creado");

            $academicUnit = AcademicUnit::where('key', $row->academicUnitKey())->first();

            if (!$academicUnit) {
                Log::channel('studentsimport')->warning("el estudiante $name no cuenta con unidad académica");
                continue;
            }

            $student->academicUnits()->sync($academicUnit->id);
        }
    }

    public function chunkSize(): int
    {
        return 500;
    }
}

class Row
{
    private $_row;

    public function __construct($row)
    {
        $this->_row = $row;
    }

    public function identifier()
    {
        return $this->_row['matricula'];
    }

    public function name()
    {
        return $this->_row['nombre'];
    }

    public function email()
    {
        return $this->_row['email'];
    }

    public function academicUnitKey()
    {
        return $this->_row['clave_departamento'];
    }
}
