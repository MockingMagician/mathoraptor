<?php

namespace MockingMagician\Mathoraptor\Tests\Number;

use MockingMagician\Mathoraptor\Exceptions\ParseNumberException;
use MockingMagician\Mathoraptor\Number\BigNumber;
use PHPUnit\Framework\TestCase;

class BigNumberTest extends TestCase
{
    /**
     * @throws ParseNumberException
     */
    public function test pending()
    {
        $number = BigNumber::fromString('-12.10e-14');
        var_dump($number);
    }
}
