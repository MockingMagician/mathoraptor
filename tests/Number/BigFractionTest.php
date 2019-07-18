<?php

declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/mathoraptor/blob/master/LICENSE.md Apache License 2.0
 * @link https://github.com/MockingMagician/mathoraptor/blob/master/README.md
 */

use MockingMagician\Mathoraptor\Exceptions\ArgumentNotMatchPatternException;
use MockingMagician\Mathoraptor\Exceptions\OperationException;
use MockingMagician\Mathoraptor\Exceptions\ParseNumberException;
use MockingMagician\Mathoraptor\Number\BigFraction;
use MockingMagician\Mathoraptor\Number\BigInteger;
use MockingMagician\Mathoraptor\Number\BigNumber;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
final class BigFractionTest extends TestCase
{
    /**
     * @throws ArgumentNotMatchPatternException
     * @throws ParseNumberException
     * @throws OperationException
     */
    public function test Add(): void
    {
        $bfOne = new BigFraction(BigInteger::fromString('3'), BigInteger::fromString('7'));
        $bfTwo = new BigFraction(BigInteger::fromString('4'), BigInteger::fromString('7'));
        $bfFour = new BigFraction(BigInteger::fromString('13'), BigInteger::fromString('11'));
        $number = BigNumber::fromString('45.21');

        /** @var BigFraction $bfThree */
        $bfThree = $bfOne->add($bfTwo);
        static::assertInstanceOf(BigFraction::class, $bfThree);

        static::assertEquals('1', $bfThree->getNumerator());
        static::assertEquals('1', $bfThree->getDenominator());

        /** @var BigFraction $bfFive */
        $bfFive = $bfOne->add($bfFour);
        static::assertInstanceOf(BigFraction::class, $bfFive);

        static::assertEquals('124', $bfFive->getNumerator());
        static::assertEquals('77', $bfFive->getDenominator());

        /** @var BigFraction $bfSix */
        $bfSix = $bfOne->add($number);
        static::assertInstanceOf(BigFraction::class, $bfFive);

        static::assertEquals('31947', $bfSix->getNumerator());
        static::assertEquals('700', $bfSix->getDenominator());
    }

    /**
     * @throws ArgumentNotMatchPatternException
     * @throws OperationException
     * @throws ParseNumberException
     */
    public function test Sub(): void
    {
        $bfOne = new BigFraction(BigInteger::fromString('3'), BigInteger::fromString('7'));
        $bfTwo = new BigFraction(BigInteger::fromString('4'), BigInteger::fromString('7'));
        $bfFour = new BigFraction(BigInteger::fromString('13'), BigInteger::fromString('11'));
        $number = BigNumber::fromString('45.21');

        /** @var BigFraction $bfThree */
        $bfThree = $bfOne->sub($bfTwo);
        static::assertInstanceOf(BigFraction::class, $bfThree);

        static::assertEquals('-1', $bfThree->getNumerator());
        static::assertEquals('7', $bfThree->getDenominator());

        /** @var BigFraction $bfFive */
        $bfFive = $bfOne->sub($bfFour);
        static::assertInstanceOf(BigFraction::class, $bfFive);

        static::assertEquals('-58', $bfFive->getNumerator());
        static::assertEquals('77', $bfFive->getDenominator());

        /** @var BigFraction $bfSix */
        $bfSix = $bfOne->sub($number);
        static::assertInstanceOf(BigFraction::class, $bfFive);

        static::assertEquals('-31347', $bfSix->getNumerator());
        static::assertEquals('700', $bfSix->getDenominator());
    }

    public function test MultiplyBy(): void
    {
    }

    public function test DivideBy(): void
    {
    }
}
