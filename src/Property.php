<?php

declare(strict_types=1);

namespace Bulychev\Enums;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class Property
{
    /** @var string[] */
    public array $properties;

    public function __construct(mixed ...$properties)
    {
        $this->properties = $properties;
    }
}
