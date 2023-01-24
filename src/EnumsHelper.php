<?php

declare(strict_types=1);

namespace Bulychev\Enums;

use BackedEnum;
use ReflectionEnum;
use ReflectionEnumUnitCase;

use function array_key_exists;

trait EnumsHelper
{
    public function __invoke(): int|string
    {
        return $this instanceof BackedEnum ? $this->value : $this->name;
    }

    /**
     * @param array<mixed> $args
     * @throws Exceptions\UndefinedEnumCaseException
     */
    public static function __callStatic(string $name, array $args): int|string
    {
        $cases = self::cases();
        /** @phpstan-ignore-next-line */
        foreach ($cases as $case) {
            if ($name === $case->name) {
                return $case instanceof BackedEnum ? $case->value : $case->name;
            }
        }

        throw new Exceptions\UndefinedEnumCaseException(self::class . '::' . $name);
    }

    /**
     * @return array<string>
     */
    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    /**
     * @return array<int|string>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * @return array<int|string>
     */
    public static function array(): array
    {
        /** @var non-empty-array<mixed> $cases */
        $cases = self::cases();

        return array_key_exists(0, $cases) && $cases[0] instanceof BackedEnum
            ? array_combine(self::values(), self::names())
            : array_column($cases, 'name');
    }

    public function description(): ?string
    {
        $reflection = new ReflectionEnum($this);

        if ($reflection->getAttributes() && $reflection->getAttributes()[0]->newInstance() instanceof Property) {
            $caseAttributes = (new ReflectionEnumUnitCase($this::class, $this->name))->getAttributes();

            return $caseAttributes && $caseAttributes[0]->newInstance() instanceof Description
                ? $caseAttributes[0]->newInstance()->description
                : null;
        }

        return null;
    }
}
