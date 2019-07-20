<?php

declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/mathoraptor/blob/master/LICENSE.md Apache License 2.0
 * @link https://github.com/MockingMagician/mathoraptor/blob/master/README.md
 */

use MockingMagician\Mathoraptor\Exceptions\ArgumentNotMatchPatternException;
use MockingMagician\Mathoraptor\Exceptions\ParseNumberException;
use MockingMagician\Mathoraptor\Helpers\Parser;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class ParserTest extends TestCase
{
    /**
     * @throws ParseNumberException
     * @throws ArgumentNotMatchPatternException
     */
    public function test parse number exception(): void
    {
        $this->expectException(ParseNumberException::class);
        Parser::parseNumber('azerty');
    }

    /**
     * @throws ParseNumberException
     * @throws ArgumentNotMatchPatternException
     */
    public function test parse number ok(): void
    {
        $toTest = [
            [' +0012.15684000', '12.15684'],
            ['12e-4', '0.0012'],
            ['12345.4e-4', '1.23454'],
            ['    -12345.678900e4', '-123456789'],
            ['   -0001234.5678000e-5   ', '-0.012345678'],
        ];

        foreach ($toTest as $test) {
            static::assertEquals($test[1], Parser::parseNumber($test[0]));
        }
    }
}
