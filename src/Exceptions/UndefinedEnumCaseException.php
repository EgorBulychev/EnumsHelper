<?php

declare(strict_types=1);

namespace Bulychev\Enums\Exceptions;

use Exception;

class UndefinedEnumCaseException extends Exception
{
    public function __construct(string $enumCase)
    {
        parent::__construct('Undefined enum case ' . $enumCase);
    }
}
