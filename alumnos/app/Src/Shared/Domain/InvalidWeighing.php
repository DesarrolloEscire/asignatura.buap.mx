<?php

namespace App\Src\Shared\Domain;

use App\Src\Shared\Domain\BusinessException;

class InvalidWeighing extends BusinessException
{

    public function __construct(?string $message = null)
    {
        parent::__construct(
            $message ?? 'El rango de la ponderación es de 0 a 10'
        );
    }
}
