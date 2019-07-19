# Description

mathoraptor is a PHP library for dealing with big number in an object mode.


# Install

Simply run 
````bash
composer require mocking-magician/mathoraptor
````

# Examples

````PHP
<?

use MockingMagician\Mathoraptor\Number\BigNumber;
use MockingMagician\Mathoraptor\Number\BigInteger;
use MockingMagician\Mathoraptor\Number\BigFraction;
use MockingMagician\Mathoraptor\Exceptions\ParseIntegerException;

// float
$bigNumber = BigNumber::fromString('1.2');
// or integer
$bigNumber = BigNumber::fromString('1');

// or strict integer
$bigInteger = BigInteger::fromString('1');
try {
    // that throw an error if not integer
    $bigInteger = BigInteger::fromString('1.1');
} catch (ParseIntegerException $e) {
}

// fraction
$bigFraction = new BigFraction(BigInteger::fromString('11'), BigInteger::fromString('7'));

// Available operation are :
// - add
// - sub
// - multiplyBy
// - divideBy

$bigNumber->add($bigInteger); // return a new BigNumber
$bigNumber->sub($bigInteger); // return a new BigNumber
// ... multiplyBy
// ... divideBy

$bigNumber->add($bigFraction); // return a new BigFraction
// ... multiplyBy
// ... divideBy

````

# What's next ?

- [ ] Adding more operation like pow, mod, etc...
