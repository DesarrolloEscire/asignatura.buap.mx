<?php

namespace App\Src\Subjects\Domain;

use App\Models\Subject;
use App\Src\Shared\Domain\BusinessException;

class NumberOfCollaboratorsExcedeed extends BusinessException
{
    public function __construct($message = null)
    {
        parent::__construct(
            $message ?? "El número máximo de colaboradores es " . Subject::MAXIMUM_NUMBER_OF_COLLABORATORS
        );
    }
}
