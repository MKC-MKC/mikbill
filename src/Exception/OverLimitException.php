<?php

namespace Haikiri\MikBiLL\Exception;

use LogicException;

class OverLimitException extends LogicException
{
	public function __construct(string $message = "Превышен лимит операции", int $code = -14, $previous = null)
	{
		parent::__construct($message, $code, $previous);
	}

}
