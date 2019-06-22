<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/mathoraptor/blob/master/LICENSE.md Apache License 2.0
 * @link https://github.com/MockingMagician/mathoraptor/blob/master/README.md
 */

namespace MockingMagician\Mathoraptor\Tests\Number;

use MockingMagician\Mathoraptor\Exceptions\ParseNumberException;
use MockingMagician\Mathoraptor\Number\BigNumber;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class BigNumberTest extends TestCase
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
