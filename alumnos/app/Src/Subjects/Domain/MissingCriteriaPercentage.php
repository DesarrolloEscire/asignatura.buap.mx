<?php

namespace App\Src\Subjects\Domain;

use App\Src\Shared\Domain\BusinessException;

class MissingCriteriaPercentage extends BusinessException
{
    public function __construct($message = null)
    {
        parent::__construct(
            $message ?? "No se ha completado el 100% en la ponderación"
        );
    }
}
