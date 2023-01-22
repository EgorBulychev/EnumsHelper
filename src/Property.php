<?php
declare(strict_types=1);

#[Attribute(Attribute::TARGET_CLASS)]
class Property
{
    public array $properties;

    public function __construct(mixed ...$properties)
    {
        $this->properties = $properties;
    }
}
