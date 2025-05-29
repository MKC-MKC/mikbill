<?php

namespace Haikiri\MikBiLL\Exception;

use LogicException;

class ActivationErrorException extends LogicException
{
	public function __construct(string $message = "Ошибка активации", int $code = -28, $previous = null)
	{
		parent::__construct($message, $code, $previous);
	}

}
