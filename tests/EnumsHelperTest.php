<?php

declare(strict_types=1);

namespace Bulychev\Enums\Tests;

use Bulychev\Enums\Description;
use Bulychev\Enums\EnumsHelper;
use Bulychev\Enums\Exceptions\UndefinedEnumCaseException;
use Bulychev\Enums\Property;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class EnumsHelperTest extends TestCase
{
    public function testValues(): void
    {
        self::assertSame([1, 2], Status::values());
        self::assertSame(['red color', 'white color'], Color::values());
        self::assertSame([], Lang::values());
        self::assertSame([], Nothing::values());
    }

    public function testNames(): void
    {
        self::assertSame(['OPEN', 'CLOSE'], Status::names());
        self::assertSame(['RED', 'WHITE'], Color::names());
        self::assertSame(['RU', 'KG'], Lang::names());
        self::assertSame([], Nothing::names());
    }

    public function testArray(): void
    {
        self::assertSame([1 => 'OPEN', 2 => 'CLOSE'], Status::array());
        self::assertSame(['red color' => 'RED', 'white color' => 'WHITE'], Color::array());
        self::assertSame(['RU', 'KG'], Lang::array());
        self::assertSame([], Nothing::array());
    }

    public function testDescription(): void
    {
        self::assertSame('Русский язык', Lang::RU->description());
        self::assertSame('Open status', Status::OPEN->description());
        self::assertSame('Белый', Color::WHITE->description());
        self::assertNull(Status::CLOSE->description());
        self::assertNull(Color::RED->description());
    }

    public function testInvoke(): void
    {
        $open = Status::OPEN;
        self::assertSame(1, $open());
        self::assertSame(1, Status::OPEN());
        self::assertSame('red color', Color::RED());
        self::assertSame('KG', Lang::KG());

        $this->expectException(UndefinedEnumCaseException::class);

        Status::NEW();
    }
}

/**
 * @method static int OPEN()
 * @method static int NEW()
 */
#[Property(Description::class)]
enum Status: int
{
    use EnumsHelper;

    #[Description('Open status')]
    case OPEN = 1;
    case CLOSE = 2;
}

/**
 * @method static string RED()
 */
#[Property(Description::class)]
enum Color: string
{
    use EnumsHelper;

    case RED = 'red color';

    #[Description('Белый')]
    case WHITE = 'white color';
}

/**
 * @method static string KG()
 */
#[Property(Description::class)]
enum Lang
{
    use EnumsHelper;
    #[Description('Русский язык')]
    case RU;
    #[Description('Кыргыз тили')]
    case KG;
}

enum Nothing
{
    use EnumsHelper;
}
