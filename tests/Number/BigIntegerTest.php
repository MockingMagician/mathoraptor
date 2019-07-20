<?php

declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/mathoraptor/blob/master/LICENSE.md Apache License 2.0
 * @link https://github.com/MockingMagician/mathoraptor/blob/master/README.md
 */

use MockingMagician\Mathoraptor\Exceptions\ArgumentNotMatchPatternException;
use MockingMagician\Mathoraptor\Exceptions\OperationException;
use MockingMagician\Mathoraptor\Exceptions\ParseIntegerException;
use MockingMagician\Mathoraptor\Exceptions\ParseNumberException;
use MockingMagician\Mathoraptor\Number\BigFraction;
use MockingMagician\Mathoraptor\Number\BigInteger;
use MockingMagician\Mathoraptor\Number\BigNumber;
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
    public function testFromString(): void
    {
        static::assertInstanceOf(BigInteger::class, BigInteger::fromString('123456'));
    }

    /**
     * @throws ArgumentNotMatchPatternException
     * @throws ParseNumberException
     */
    public function testFromStringException(): void
    {
        static::expectException(ParseIntegerException::class);
        static::assertInstanceOf(BigInteger::class, BigInteger::fromString('123456.789'));
    }

    /**
     * @throws ArgumentNotMatchPatternException
     * @throws OperationException
     * @throws ParseNumberException
     */
    public function testAdd(): void
    {
        $n1 = BigInteger::fromString('1111');
        $n2 = BigNumber::fromString('123.5678');
        $r1 = $n1->add($n2);
        static::assertInstanceOf(BigNumber::class, $r1);
        /** @var BigNumber $r1 */
        static::assertEquals('1234.5678', $r1->getNumber());

        $n3 = BigInteger::fromString('123');
        $r2 = $n1->add($n3);
        static::assertInstanceOf(BigNumber::class, $r2);
        /** @var BigNumber $r2 */
        static::assertEquals('1234', $r2->getNumber());

        $n4 = new BigFraction(BigInteger::fromString('4'), BigInteger::fromString('2'));
        $r3 = $n1->add($n4);
        static::assertInstanceOf(BigFraction::class, $r3);
        /** @var BigFraction $r3 */
        static::assertEquals('1113', $r3->getNumerator()->getNumber());
        static::assertEquals('1', $r3->getDenominator()->getNumber());
    }

    /**
     * @throws ArgumentNotMatchPatternException
     * @throws ParseNumberException
     * @throws OperationException
     */
    public function testSub(): void
    {
        $n1 = BigInteger::fromString('1234');
        $n2 = BigNumber::fromString('123.1111');
        $r1 = $n1->sub($n2);
        static::assertInstanceOf(BigNumber::class, $r1);
        /** @var BigNumber $r1 */
        static::assertEquals('1110.8889', $r1->getNumber());

        $n3 = BigInteger::fromString('123');
        $r2 = $n1->sub($n3);
        static::assertInstanceOf(BigNumber::class, $r2);
        /** @var BigNumber $r2 */
        static::assertEquals('1111', $r2->getNumber());

        $n4 = new BigFraction(BigInteger::fromString('4'), BigInteger::fromString('2'));
        $r3 = $n1->sub($n4);
        static::assertInstanceOf(BigFraction::class, $r3);
        /** @var BigFraction $r3 */
        static::assertEquals('1232', $r3->getNumerator()->getNumber());
        static::assertEquals('1', $r3->getDenominator()->getNumber());
    }

    /**
     * @throws ArgumentNotMatchPatternException
     * @throws OperationException
     * @throws ParseNumberException
     */
    public function testMultiplyBy(): void
    {
        $n1 = BigInteger::fromString('22');
        $n2 = BigNumber::fromString('33.33');
        $r1 = $n1->multiplyBy($n2);
        static::assertInstanceOf(BigNumber::class, $r1);
        /** @var BigNumber $r1 */
        static::assertEquals('733.26', $r1->getNumber());

        $n3 = BigInteger::fromString('33');
        $r2 = $n1->multiplyBy($n3);
        static::assertInstanceOf(BigNumber::class, $r2);
        /** @var BigNumber $r2 */
        static::assertEquals('726', $r2->getNumber());

        $n4 = new BigFraction(BigInteger::fromString('5'), BigInteger::fromString('2'));
        $r3 = $n1->multiplyBy($n4);
        static::assertInstanceOf(BigFraction::class, $r3);
        /** @var BigFraction $r3 */
        static::assertEquals('55', $r3->getNumerator()->getNumber());
        static::assertEquals('1', $r3->getDenominator()->getNumber());
    }

    /**
     * @throws ArgumentNotMatchPatternException
     * @throws OperationException
     * @throws ParseNumberException
     */
    public function testDivideBy(): void
    {
        $n1 = BigInteger::fromString('22');
        $n2 = BigNumber::fromString('33.33');
        $r1 = $n1->divideBy($n2);
        static::assertInstanceOf(BigFraction::class, $r1);
        /** @var BigFraction $r1 */
        static::assertEquals('200', $r1->getNumerator()->getNumber());
        static::assertEquals('303', $r1->getDenominator()->getNumber());

        $n3 = BigInteger::fromString('33');
        $r2 = $n1->divideBy($n3);
        static::assertInstanceOf(BigFraction::class, $r2);
        /** @var BigFraction $r2 */
        static::assertEquals('2', $r2->getNumerator()->getNumber());
        static::assertEquals('3', $r2->getDenominator()->getNumber());

        $n4 = new BigFraction(BigInteger::fromString('5'), BigInteger::fromString('2'));
        $r3 = $n1->divideBy($n4);
        static::assertInstanceOf(BigFraction::class, $r3);
        /** @var BigFraction $r3 */
        static::assertEquals('44', $r3->getNumerator()->getNumber());
        static::assertEquals('5', $r3->getDenominator()->getNumber());
    }
}
