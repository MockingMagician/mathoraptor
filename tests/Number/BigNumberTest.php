<?php

declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/mathoraptor/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/MockingMagician/mathoraptor/blob/master/README.md
 */

namespace MockingMagician\Mathoraptor\Tests\Number;

use MockingMagician\Mathoraptor\Exceptions\ArgumentNotMatchPatternException;
use MockingMagician\Mathoraptor\Exceptions\OperationException;
use MockingMagician\Mathoraptor\Exceptions\ParseNumberException;
use MockingMagician\Mathoraptor\Number\BigFraction;
use MockingMagician\Mathoraptor\Number\BigInteger;
use MockingMagician\Mathoraptor\Number\BigNumber;
use MockingMagician\Mathoraptor\Operation\BasicOperationsInterface;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class BigNumberTest extends TestCase
{
    private $notImplemented;

    protected function setUp(): void
    {
        parent::setUp();
        $this->notImplemented = $this->prophesize(BasicOperationsInterface::class)->reveal();
    }

    /**
     * @throws ArgumentNotMatchPatternException
     * @throws ParseNumberException
     */
    public function testFromString(): void
    {
        static::assertInstanceOf(BigNumber::class, BigNumber::fromString('1234.5678'));
    }

    /**
     * @throws ArgumentNotMatchPatternException
     * @throws ParseNumberException
     */
    public function test getIntegerPart(): void
    {
        $bn = BigNumber::fromString('1234');
        static::assertEquals('1234', $bn->getIntegerPart());
    }

    /**
     * @throws ArgumentNotMatchPatternException
     * @throws OperationException
     * @throws ParseNumberException
     */
    public function testAdd(): void
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
    public function test Add throw exception(): void
    {
        static::expectException(OperationException::class);
        BigNumber::fromString('1111.1111')->add($this->notImplemented);
    }

    /**
     * @throws ArgumentNotMatchPatternException
     * @throws ParseNumberException
     * @throws OperationException
     */
    public function testSub(): void
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

    /**
     * @throws ArgumentNotMatchPatternException
     * @throws ParseNumberException
     * @throws OperationException
     */
    public function test sub throw exception(): void
    {
        static::expectException(OperationException::class);
        BigNumber::fromString('1111.1111')->sub($this->notImplemented);
    }

    /**
     * @throws ArgumentNotMatchPatternException
     * @throws OperationException
     * @throws ParseNumberException
     */
    public function testMultiplyBy(): void
    {
        $n1 = BigNumber::fromString('22.22');
        $n2 = BigNumber::fromString('33.33');
        $r1 = $n1->multiplyBy($n2);
        static::assertInstanceOf(BigNumber::class, $r1);
        /** @var BigNumber $r1 */
        static::assertEquals('740.5926', $r1->getNumber());

        $n3 = BigInteger::fromString('33');
        $r2 = $n1->multiplyBy($n3);
        static::assertInstanceOf(BigNumber::class, $r2);
        /** @var BigNumber $r2 */
        static::assertEquals('733.26', $r2->getNumber());

        $n4 = new BigFraction(BigInteger::fromString('3'), BigInteger::fromString('2'));
        $r3 = $n1->multiplyBy($n4);
        static::assertInstanceOf(BigFraction::class, $r3);
        /** @var BigFraction $r3 */
        static::assertEquals('3333', $r3->getNumerator()->getNumber());
        static::assertEquals('100', $r3->getDenominator()->getNumber());
    }

    /**
     * @throws ArgumentNotMatchPatternException
     * @throws ParseNumberException
     * @throws OperationException
     */
    public function test multiplyBy throw exception(): void
    {
        static::expectException(OperationException::class);
        BigNumber::fromString('1111.1111')->multiplyBy($this->notImplemented);
    }

    /**
     * @throws ArgumentNotMatchPatternException
     * @throws OperationException
     * @throws ParseNumberException
     */
    public function testDivideBy(): void
    {
        $n1 = BigNumber::fromString('22.22');
        $n2 = BigNumber::fromString('33.33');
        $r1 = $n1->divideBy($n2);
        static::assertInstanceOf(BigFraction::class, $r1);
        /** @var BigFraction $r1 */
        static::assertEquals('202', $r1->getNumerator()->getNumber());
        static::assertEquals('303', $r1->getDenominator()->getNumber());

        $n3 = BigInteger::fromString('33');
        $r2 = $n1->divideBy($n3);
        static::assertInstanceOf(BigFraction::class, $r2);
        /** @var BigFraction $r2 */
        static::assertEquals('101', $r2->getNumerator()->getNumber());
        static::assertEquals('150', $r2->getDenominator()->getNumber());

        $n4 = new BigFraction(BigInteger::fromString('3'), BigInteger::fromString('2'));
        $r3 = $n1->divideBy($n4);
        static::assertInstanceOf(BigFraction::class, $r3);
        /** @var BigFraction $r3 */
        static::assertEquals('1111', $r3->getNumerator()->getNumber());
        static::assertEquals('75', $r3->getDenominator()->getNumber());
    }

    /**
     * @throws ArgumentNotMatchPatternException
     * @throws ParseNumberException
     * @throws OperationException
     */
    public function test divideBy throw exception(): void
    {
        static::expectException(OperationException::class);
        BigNumber::fromString('1111.1111')->divideBy($this->notImplemented);
    }
}
