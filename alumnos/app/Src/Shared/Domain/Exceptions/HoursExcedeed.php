<?php

namespace App\Src\Shared\Domain\Exceptions;

use App\Src\Shared\Domain\BusinessException;

class HoursExcedeed extends BusinessException
{
    public function __construct(?string $message = null)
    {
        parent::__construct(
            $message ?? "Superaste el límite de horas permitido."
        );
    }
}
