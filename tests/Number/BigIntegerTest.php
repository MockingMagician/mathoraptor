<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/mathoraptor/blob/master/LICENSE.md Apache License 2.0
 * @link https://github.com/MockingMagician/mathoraptor/blob/master/README.md
 */

use MockingMagician\Mathoraptor\Exceptions\ArgumentNotMatchPatternException;
use MockingMagician\Mathoraptor\Exceptions\ParseNumberException;
use MockingMagician\Mathoraptor\Number\BigInteger;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class BigIntegerTest extends TestCase
{
    /**
     * @throws ArgumentNotMatchPatternException
     * @throws ParseNumberException
     */
    public function testFromString()
    {
        $this->assertInstanceOf(BigInteger::class, BigInteger::fromString('123456'));
    }
}
