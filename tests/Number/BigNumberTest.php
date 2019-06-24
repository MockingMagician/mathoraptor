<?php

use MockingMagician\Mathoraptor\Exceptions\ArgumentNotMatchPatternException;
use MockingMagician\Mathoraptor\Exceptions\OperationException;
use MockingMagician\Mathoraptor\Exceptions\ParseNumberException;
use MockingMagician\Mathoraptor\Number\BigFraction;
use MockingMagician\Mathoraptor\Number\BigInteger;
use MockingMagician\Mathoraptor\Number\BigNumber;
use PHPUnit\Framework\TestCase;

class BigNumberTest extends TestCase
{
    /**
     * @throws ArgumentNotMatchPatternException
     * @throws ParseNumberException
     */
    public function testFromString()
    {
        static::assertInstanceOf(BigNumber::class, BigNumber::fromString('1234.5678'));
    }

    /**
     * @throws ArgumentNotMatchPatternException
     * @throws OperationException
     * @throws ParseNumberException
     */
    public function testAdd()
    {
        $n1 = BigNumber::fromString('1111.1111');
        $n2 = BigNumber::fromString('123.4567');
        $r1 = $n1->add($n2);
        static::assertInstanceOf(BigNumber::class, $r1);
        /** @var BigNumber $r1 */
        static::assertEquals('1234.5678', $r1->getNumber());

        $n3 = BigInteger::fromString('123');
        $r2 = $n1->add($n3);
        static::assertInstanceOf(BigNumber::class, $r2);
        /** @var BigNumber $r2 */
        static::assertEquals('1234.1111', $r2->getNumber());

        $n4 = new BigFraction(BigInteger::fromString('4'), BigInteger::fromString('2'));
        $r3 = $n1->add($n4);
        static::assertInstanceOf(BigFraction::class, $r3);
        /** @var BigFraction $r3 */
        static::assertEquals('11131111', $r3->getNumerator()->getNumber());
        static::assertEquals('10000', $r3->getDenominator()->getNumber());
    }

    /**
     * @throws ArgumentNotMatchPatternException
     * @throws ParseNumberException
     * @throws OperationException
     */
    public function testSub()
    {
        $n1 = BigNumber::fromString('1234.5678');
        $n2 = BigNumber::fromString('123.4567');
        $r1 = $n1->sub($n2);
        static::assertInstanceOf(BigNumber::class, $r1);
        /** @var BigNumber $r1 */
        static::assertEquals('1111.1111', $r1->getNumber());

        $n3 = BigInteger::fromString('123');
        $r2 = $n1->sub($n3);
        static::assertInstanceOf(BigNumber::class, $r2);
        /** @var BigNumber $r2 */
        static::assertEquals('1111.5678', $r2->getNumber());

        $n4 = new BigFraction(BigInteger::fromString('4'), BigInteger::fromString('2'));
        $r3 = $n1->sub($n4);
        static::assertInstanceOf(BigFraction::class, $r3);
        /** @var BigFraction $r3 */
        static::assertEquals('6162839', $r3->getNumerator()->getNumber());
        static::assertEquals('5000', $r3->getDenominator()->getNumber());
    }

    public function testDivideBy()
    {

    }

    public function testMultiplyBy()
    {

    }
}
