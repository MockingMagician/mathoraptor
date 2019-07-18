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
    /** @var BigFraction */
    public $bf1;
    /** @var BigFraction */
    public $bf2;
    /** @var BigFraction */
    public $bf3;
    /** @var BigNumber */
    public $number1;

    /**
     * @throws ArgumentNotMatchPatternException
     * @throws ParseNumberException
     */
    protected function setUp(): void
    {
        parent::setUpBeforeClass();
        $this->bf1 = new BigFraction(BigInteger::fromString('3'), BigInteger::fromString('7'));
        $this->bf2 = new BigFraction(BigInteger::fromString('4'), BigInteger::fromString('7'));
        $this->bf3 = new BigFraction(BigInteger::fromString('13'), BigInteger::fromString('11'));
        $this->number1 = BigNumber::fromString('45.21');
    }

    /**
     * @throws ArgumentNotMatchPatternException
     * @throws ParseNumberException
     * @throws OperationException
     */
    public function test Add(): void
    {
        /** @var BigFraction $bf */
        $bf = $this->bf1->add($this->bf2);
        static::assertInstanceOf(BigFraction::class, $bf);

        static::assertEquals('1', $bf->getNumerator());
        static::assertEquals('1', $bf->getDenominator());

        $bf = $this->bf1->add($this->bf3);
        static::assertInstanceOf(BigFraction::class, $bf);

        static::assertEquals('124', $bf->getNumerator());
        static::assertEquals('77', $bf->getDenominator());

        $bf = $this->bf1->add($this->number1);
        static::assertInstanceOf(BigFraction::class, $bf);

        static::assertEquals('31947', $bf->getNumerator());
        static::assertEquals('700', $bf->getDenominator());
    }

    /**
     * @throws ArgumentNotMatchPatternException
     * @throws OperationException
     * @throws ParseNumberException
     */
    public function test Sub(): void
    {
        /** @var BigFraction $bf */
        $bf = $this->bf1->sub($this->bf2);
        static::assertInstanceOf(BigFraction::class, $bf);

        static::assertEquals('-1', $bf->getNumerator());
        static::assertEquals('7', $bf->getDenominator());

        $bf = $this->bf1->sub($this->bf3);
        static::assertInstanceOf(BigFraction::class, $bf);

        static::assertEquals('-58', $bf->getNumerator());
        static::assertEquals('77', $bf->getDenominator());

        $bf = $this->bf1->sub($this->number1);
        static::assertInstanceOf(BigFraction::class, $bf);

        static::assertEquals('-31347', $bf->getNumerator());
        static::assertEquals('700', $bf->getDenominator());
    }

    /**
     * @throws ArgumentNotMatchPatternException
     * @throws OperationException
     * @throws ParseNumberException
     */
    public function test MultiplyBy(): void
    {
        /** @var BigFraction $bf */
        $bf = $this->bf1->multiplyBy($this->bf2);
        static::assertInstanceOf(BigFraction::class, $bf);

        static::assertEquals('12', $bf->getNumerator());
        static::assertEquals('49', $bf->getDenominator());

        $bf = $this->bf1->multiplyBy($this->bf3);
        static::assertInstanceOf(BigFraction::class, $bf);

        static::assertEquals('39', $bf->getNumerator());
        static::assertEquals('77', $bf->getDenominator());

        $bf = $this->bf1->multiplyBy($this->number1);
        static::assertInstanceOf(BigFraction::class, $bf);

        static::assertEquals('13563', $bf->getNumerator());
        static::assertEquals('700', $bf->getDenominator());
    }

    /**
     * @throws ArgumentNotMatchPatternException
     * @throws OperationException
     * @throws ParseNumberException
     */
    public function test DivideBy(): void
    {
        /** @var BigFraction $bf */
        $bf = $this->bf1->divideBy($this->bf2);
        static::assertInstanceOf(BigFraction::class, $bf);

        static::assertEquals('3', $bf->getNumerator());
        static::assertEquals('4', $bf->getDenominator());

        $bf = $this->bf1->divideBy($this->bf3);
        static::assertInstanceOf(BigFraction::class, $bf);

        static::assertEquals('33', $bf->getNumerator());
        static::assertEquals('91', $bf->getDenominator());

        $bf = $this->bf1->divideBy($this->number1);
        static::assertInstanceOf(BigFraction::class, $bf);

        static::assertEquals('100', $bf->getNumerator());
        static::assertEquals('10549', $bf->getDenominator());
    }
}
