<?php

declare(strict_types=1);

namespace Bulychev\Enums\Tests;

use Bulychev\Enums\Description;
use Bulychev\Enums\EnumsHelper;
use Bulychev\Enums\Exceptions\UndefinedEnumCaseException;
use Bulychev\Enums\Property;
use PHPUnit\Framework\TestCase;

class EnumsHelperTest extends TestCase
{
    public function testValues(): void
    {
        self::assertSame([1, 10, 50], Request::values());
        self::assertSame([], Role::values());
    }

    public function testNames(): void
    {
        self::assertSame(['OPEN', 'PENDING', 'DONE'], Request::names());
        self::assertSame(['ADMIN', 'MANAGER'], Role::names());
    }

    public function testArray(): void
    {
        self::assertSame([1 => 'OPEN', 10 => 'PENDING', 50 => 'DONE'], Request::array());
        self::assertSame(['ADMIN', 'MANAGER'], Role::array());
    }

    public function testDescription(): void
    {
        self::assertSame('Admin role', Role::ADMIN->description());
        self::assertNull(Role::MANAGER->description());
        self::assertNull(Request::OPEN->description());
    }

    public function testInvoke(): void
    {
        $open = Request::OPEN;
        self::assertSame(1, $open());
        self::assertSame(1, Request::OPEN());
        self::assertSame('ADMIN', Role::ADMIN());

        $this->expectException(UndefinedEnumCaseException::class);

        Role::USER();
    }
}

/**
 * @method static OPEN()
 */
enum Request: int
{
    use EnumsHelper;

    case OPEN = 1;
    case PENDING = 10;
    case DONE = 50;
}

/**
 * @method static ADMIN()
 */
#[Property(Description::class)]
enum Role
{
    use EnumsHelper;

    #[Description('Admin role')]
    case ADMIN;
    case MANAGER;
}
