<?php

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

    /**
     * @throws ArgumentNotMatchPatternException
     * @throws OperationException
     * @throws ParseNumberException
     */
    public function testAdd()
    {
        $n1 = BigInteger::fromString('1111');
        $n2 = BigNumber::fromString('123.5678');
        $r1 = $n1->add($n2);
        $this->assertInstanceOf(BigNumber::class, $r1);
        // @var BigNumber $r1
        $this->assertEquals('1234.5678', $r1->getNumber());

        $n3 = BigInteger::fromString('123');
        $r2 = $n1->add($n3);
        $this->assertInstanceOf(BigNumber::class, $r2);
        // @var BigNumber $r2
        $this->assertEquals('1234', $r2->getNumber());

        $n4 = new BigFraction(BigInteger::fromString('4'), BigInteger::fromString('2'));
        $r3 = $n1->add($n4);
        $this->assertInstanceOf(BigFraction::class, $r3);
        // @var BigFraction $r3
        $this->assertEquals('1113', $r3->getNumerator()->getNumber());
        $this->assertEquals('1', $r3->getDenominator()->getNumber());
    }

    /**
     * @throws ArgumentNotMatchPatternException
     * @throws ParseNumberException
     * @throws OperationException
     */
    public function testSub()
    {
        $n1 = BigInteger::fromString('1234');
        $n2 = BigNumber::fromString('123.1111');
        $r1 = $n1->sub($n2);
        $this->assertInstanceOf(BigNumber::class, $r1);
        // @var BigNumber $r1
        $this->assertEquals('1110.8889', $r1->getNumber());

        $n3 = BigInteger::fromString('123');
        $r2 = $n1->sub($n3);
        $this->assertInstanceOf(BigNumber::class, $r2);
        // @var BigNumber $r2
        $this->assertEquals('1111', $r2->getNumber());

        $n4 = new BigFraction(BigInteger::fromString('4'), BigInteger::fromString('2'));
        $r3 = $n1->sub($n4);
        $this->assertInstanceOf(BigFraction::class, $r3);
        // @var BigFraction $r3
        $this->assertEquals('1232', $r3->getNumerator()->getNumber());
        $this->assertEquals('1', $r3->getDenominator()->getNumber());
    }

    /**
     * @throws ArgumentNotMatchPatternException
     * @throws OperationException
     * @throws ParseNumberException
     */
    public function testMultiplyBy()
    {
        $n1 = BigInteger::fromString('22');
        $n2 = BigNumber::fromString('33.33');
        $r1 = $n1->multiplyBy($n2);
        $this->assertInstanceOf(BigNumber::class, $r1);
        // @var BigNumber $r1
        $this->assertEquals('733.26', $r1->getNumber());

        $n3 = BigInteger::fromString('33');
        $r2 = $n1->multiplyBy($n3);
        $this->assertInstanceOf(BigNumber::class, $r2);
        // @var BigNumber $r2
        $this->assertEquals('726', $r2->getNumber());

        $n4 = new BigFraction(BigInteger::fromString('5'), BigInteger::fromString('2'));
        $r3 = $n1->multiplyBy($n4);
        $this->assertInstanceOf(BigFraction::class, $r3);
        // @var BigFraction $r3
        $this->assertEquals('55', $r3->getNumerator()->getNumber());
        $this->assertEquals('1', $r3->getDenominator()->getNumber());
    }

    /**
     * @throws ArgumentNotMatchPatternException
     * @throws OperationException
     * @throws ParseNumberException
     */
    public function testDivideBy()
    {
        $n1 = BigInteger::fromString('22');
        $n2 = BigNumber::fromString('33.33');
        $r1 = $n1->divideBy($n2);
        $this->assertInstanceOf(BigFraction::class, $r1);
        // @var BigFraction $r1
        $this->assertEquals('200', $r1->getNumerator()->getNumber());
        $this->assertEquals('303', $r1->getDenominator()->getNumber());

        $n3 = BigInteger::fromString('33');
        $r2 = $n1->divideBy($n3);
        $this->assertInstanceOf(BigFraction::class, $r2);
        // @var BigFraction $r2
        $this->assertEquals('2', $r2->getNumerator()->getNumber());
        $this->assertEquals('3', $r2->getDenominator()->getNumber());

        $n4 = new BigFraction(BigInteger::fromString('5'), BigInteger::fromString('2'));
        $r3 = $n1->divideBy($n4);
        $this->assertInstanceOf(BigFraction::class, $r3);
        // @var BigFraction $r3
        $this->assertEquals('44', $r3->getNumerator()->getNumber());
        $this->assertEquals('5', $r3->getDenominator()->getNumber());
    }
}
