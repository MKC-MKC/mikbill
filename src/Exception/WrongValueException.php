<?php

namespace Haikiri\MikBiLL\Exception;

use LogicException;

class WrongValueException extends LogicException
{
	public function __construct(string $message = "Неверное значение", int $code = -11)
	{
		parent::__construct($message, $code);
	}

}
