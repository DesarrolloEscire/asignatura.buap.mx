<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    const ADMINISTRATOR_ROLE = 'administrador';
    const TEACHER_ROLE = 'docente';
    const EVALUATOR_ROLE = 'evaluador';
    const COORDINATOR_ROLE = 'coordinador';
    const DIRECTOR_ROLE = 'director';
    const SECRETARY_ROLE = 'secretario';
}
