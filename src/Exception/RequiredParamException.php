<?php

namespace Haikiri\MikBiLL\Exception;

use InvalidArgumentException;

class RequiredParamException extends InvalidArgumentException
{
	public function __construct(string $message = "Не передан обязательный параметр", int $code = -422, $previous = null)
	{
		parent::__construct($message, $code, $previous);
	}

}
