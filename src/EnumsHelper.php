<?php
declare(strict_types=1);

namespace Bulychev\EnumsHelper;

use ReflectionEnum;
use ReflectionEnumUnitCase;
use BackedEnum;

trait EnumsHelper
{
    public function __invoke()
    {
        return $this instanceof BackedEnum ? $this->value : $this->name;
    }

    public static function __callStatic($name, $args)
    {
        foreach (self::cases() as $case) {
            if ($name === $case->name) {
                return $case instanceof BackedEnum ? $case->value : $case->name;
            }
        }

        throw new Exceptions\UndefinedEnumCaseException(self::class . '::' . $name);
    }

    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function array(): array
    {
        return array_combine(self::values(), self::names());
    }

    public function description(): ?string
    {
        $reflection = new ReflectionEnum($this);

        if ($reflection->getAttributes()) {
            $caseAttributes = (new ReflectionEnumUnitCase($this::class, $this->name))->getAttributes();

            return $caseAttributes
                ? $caseAttributes[0]->newInstance()->description
                : null;
        }

        return null;
    }
}
