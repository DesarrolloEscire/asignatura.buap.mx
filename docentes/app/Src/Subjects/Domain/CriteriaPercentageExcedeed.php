<?php

namespace App\Src\Subjects\Domain;

use App\Src\Shared\Domain\BusinessException;

class CriteriaPercentageExcedeed extends BusinessException
{
    public function __construct($message = null)
    {
        parent::__construct(
            $message ?? "Superaste el 100% de ponderación permitido."
        );
    }
}
