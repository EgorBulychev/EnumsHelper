# EnumsHelper
Enums Helper Traits for PHP 8.1+

## Installation
`composer require bulychev/enums`

## Usage trait

```php
/**
 * @method static int USER()
 * @method static int ADMIN()
 * @method static int ROOT()
 */
#[Property(Description::class)]
enum Role: int
{
    use EnumsHelper;

    #[Description('Standard user account')]
    case USER = 10;

    #[Description('User with advanced permissions')]
    case ADMIN = 50;

    #[Description('User with full permissions')]
    case ROOT = 99;
}
```

#### `__invoke & __callStatic`: int|string
BackedEnum
```php
Role::ADMIN(); // int(50)
Role::ROOT(); // int(99)
Role::MANAGER(); // throw new UndefinedEnumCaseException
```

UnitEnum
```php
/**
 * @method static string RU()
 * @method static string KG()
 * @method static string EN()
 */
enum Lang
{
    use EnumsHelper;
    
    case RU;
    case KG;
    case EN;
}
Role::RU(); // string(2) "RU"
Role::KG(); // string(2) "KG"
Role::EN(); // string(2) "EN"
```

#### `names()`: array
```php
Role::names();
// array(3) {
//   [0]=> string(4) "USER"
//   [1]=> string(5) "ADMIN"
//   [2]=> string(4) "ROOT"
// }
```

#### `values()`: array
```php
Role::values();
// array(3) {
//   [0]=> int(10)
//   [1]=> int(50)
//   [2]=> int(99)
// }
```

#### `array()`: array
```php
Role::array();
// array(3) {
//   [10]=> string(4) "USER"
//   [50]=> string(5) "ADMIN"
//   [99]=> string(4) "ROOT"
// }
```

#### `description()`: ?string
```php
Role::ROOT->description();
// string(26) "User with full permissions"
```
