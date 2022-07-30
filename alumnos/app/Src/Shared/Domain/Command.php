<?php

namespace App\Src\Shared\Domain;

abstract class Command
{
    public abstract function commandHandler() : CommandHandler;
}
