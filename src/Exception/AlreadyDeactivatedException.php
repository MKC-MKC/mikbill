<?php

namespace Haikiri\MikBiLL\Exception;

use LogicException;

class AlreadyDeactivatedException extends LogicException
{
	public function __construct(string $message = "Уже деактивировано", int $code = -27, $previous = null)
	{
		parent::__construct($message, $code, $previous);
	}

}
