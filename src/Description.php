<?php
declare(strict_types=1);

namespace Bulychev\EnumsHelper;

use Attribute;

#[Attribute]
class Description {
    public function __construct(public string $description)
    {
    }
}
