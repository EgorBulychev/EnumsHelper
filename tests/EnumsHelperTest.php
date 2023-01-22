<?php
declare(strict_types=1);

use Bulychev\EnumsHelper\Description;
use Bulychev\EnumsHelper\EnumsHelper;
use Bulychev\EnumsHelper\Exceptions\UndefinedEnumCaseException;
use Bulychev\EnumsHelper\Property;
use PHPUnit\Framework\TestCase;

class EnumsHelperTest extends TestCase
{
    public function testValues(): void
    {
        $this->assertSame([1, 10, 50], Request::values());
        $this->assertSame([], Role::values());
    }

    public function testNames(): void
    {
        $this->assertSame(['OPEN', 'PENDING', 'DONE'], Request::names());
        $this->assertSame(['ADMIN', 'MANAGER'], Role::names());
    }

    public function testArray(): void
    {
        $this->assertSame([1 => 'OPEN', 10 => 'PENDING', 50 => 'DONE'], Request::array());
    }

    public function testDescription(): void
    {
        $this->assertSame('Admin role', Role::ADMIN->description());
        $this->assertNull(Role::MANAGER->description());
        $this->assertNull(Request::OPEN->description());
    }

    public function testInvoke(): void
    {
        $open = Request::OPEN;
        $this->assertSame(1, $open());
        $this->assertSame(1, Request::OPEN());
        $this->assertSame('ADMIN', Role::ADMIN());

        $this->expectException(UndefinedEnumCaseException::class);

        $user = Role::USER();
    }
}

enum Request: int
{
    use EnumsHelper;

    case OPEN = 1;
    case PENDING = 10;
    case DONE = 50;
}

#[Property(Description::class)]
enum Role
{
    use EnumsHelper;

    #[Description('Admin role')]
    case ADMIN;
    case MANAGER;
}