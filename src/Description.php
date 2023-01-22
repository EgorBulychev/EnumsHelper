<?php
declare(strict_types=1);

#[Attribute]
class Description {
    public function __construct(public string $description)
    {
    }
}
