<?php

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
