<?php

namespace Haikiri\MikBiLL\Exception;

use LogicException;

class UnauthorizedException extends LogicException
{
	public function __construct(string $message = "Ошибка авторизации", int $code = -401, $previous = null)
	{
		parent::__construct($message, $code, $previous);
	}

}
