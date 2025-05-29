<?php

namespace Haikiri\MikBiLL\Exception;

use LogicException;

class AlreadyActivatedException extends LogicException
{
	public function __construct(string $message = "Уже активно", int $code = -22, $previous = null)
	{
		parent::__construct($message, $code, $previous);
	}

}
