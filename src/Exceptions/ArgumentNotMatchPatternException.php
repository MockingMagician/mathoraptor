<?php

declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/mathoraptor/blob/master/LICENSE.md Apache License 2.0
 * @link https://github.com/MockingMagician/mathoraptor/blob/master/README.md
 */

namespace MockingMagician\Mathoraptor\Exceptions;

use Throwable;

/**
 * Class ArgumentNotMatchPatternException.
 */
class ArgumentNotMatchPatternException extends \Exception
{
    public function __construct(string $argumentInStringFormat, string $pattern, int $code = 0, Throwable $previous = null)
    {
        $message = \sprintf('Argument `%s` does not match pattern `%s`', $argumentInStringFormat, $pattern);
        parent::__construct($message, $code, $previous);
    }
}
