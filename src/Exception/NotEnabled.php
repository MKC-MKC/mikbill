<?php

namespace Haikiri\MikBiLL\Exception;

use LogicException;

class NotEnabled extends LogicException
{
	public function __construct(string $message = "Функционал или модуль не активны", int $code = -10, $previous = null)
	{
		parent::__construct($message, $code, $previous);
	}

}
