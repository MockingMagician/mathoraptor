<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/mathoraptor/blob/master/LICENSE.md Apache License 2.0
 * @link https://github.com/MockingMagician/mathoraptor/blob/master/README.md
 */

namespace MockingMagician\Mathoraptor\Exceptions;

use Throwable;

class ParseNumberException extends \Exception
{
    public function __construct(string $parsedNumber, int $code = 0, Throwable $previous = null)
    {
        $message = sprintf('Can not parse `%s` to number.', $parsedNumber);
        parent::__construct($message, $code, $previous);
    }
}
