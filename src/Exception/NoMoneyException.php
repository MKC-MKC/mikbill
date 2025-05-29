<?php

namespace Haikiri\MikBiLL\Exception;

use LogicException;

class NoMoneyException extends LogicException
{
	public function __construct(string $message = "Недостаточно средств", int $code = -24, $previous = null)
	{
		parent::__construct($message, $code, $previous);
	}

}
