<?php

declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/mathoraptor/blob/master/LICENSE.md Apache License 2.0
 * @link https://github.com/MockingMagician/mathoraptor/blob/master/README.md
 */

namespace MockingMagician\Mathoraptor\Tests\Helpers\DTO;

use MockingMagician\Mathoraptor\Exceptions\ArgumentNotMatchPatternException;
use MockingMagician\Mathoraptor\Helpers\DTO\ParsedNumber;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class ParsedNumberTest extends TestCase
{
    /**
     * @throws ArgumentNotMatchPatternException
     */
    public function test new ok(): void
    {
        $number = new ParsedNumber('+', '123456', '654321', '+', 1);
        static::assertInstanceOf(ParsedNumber::class, $number);
    }

    public function test new ko(): void
    {
        $e = null;

        try {
            new ParsedNumber('', '123456', '654321', '+', 1);
        } catch (\Exception $e) {
        }

        static::assertInstanceOf(ArgumentNotMatchPatternException::class, $e);

        $e = null;

        try {
            new ParsedNumber('+', 'not a number', '654321', '+', 1);
        } catch (\Exception $e) {
        }

        static::assertInstanceOf(ArgumentNotMatchPatternException::class, $e);

        $e = null;

        try {
            new ParsedNumber('+', '123456', 'not a number', '+', 1);
        } catch (\Exception $e) {
        }

        static::assertInstanceOf(ArgumentNotMatchPatternException::class, $e);

        $e = null;

        try {
            new ParsedNumber('+', '123456', '654321', '', 1);
        } catch (\Exception $e) {
        }

        static::assertInstanceOf(ArgumentNotMatchPatternException::class, $e);
    }

    /**
     * @throws ArgumentNotMatchPatternException
     */
    public function test literal(): void
    {
        $number = new ParsedNumber('+', '1234', '5678', '+', 0);
        static::assertEquals('1234.5678', $number->getLiteral());

        $number = new ParsedNumber('-', '1234', '5678', '-', 0);
        static::assertEquals('-1234.5678', $number->getLiteral());

        $number = new ParsedNumber('+', '1234', '5678', '+', 2);
        static::assertEquals('123456.78', $number->getLiteral());

        $number = new ParsedNumber('-', '1234', '5678', '+', 4);
        static::assertEquals('-12345678', $number->getLiteral());

        $number = new ParsedNumber('+', '1234', '5678', '+', 6);
        static::assertEquals('1234567800', $number->getLiteral());

        $number = new ParsedNumber('-', '1234', '5678', '-', 2);
        static::assertEquals('-12.345678', $number->getLiteral());

        $number = new ParsedNumber('+', '1234', '5678', '-', 4);
        static::assertEquals('0.12345678', $number->getLiteral());

        $number = new ParsedNumber('-', '1234', '5678', '-', 6);
        static::assertEquals('-0.0012345678', $number->getLiteral());

        $number = new ParsedNumber('+', '000000001234', '5678000000', '-', 6);
        static::assertEquals('0.0012345678', $number->getLiteral());
    }
}
