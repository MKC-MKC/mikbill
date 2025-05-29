<?php

namespace Haikiri\MikBiLL\Exception;

use LogicException;

class WrongPasswordException extends LogicException
{
	public function __construct(string $message = "Неверный пароль", int $code = -23, $previous = null)
	{
		parent::__construct($message, $code, $previous);
	}

}
