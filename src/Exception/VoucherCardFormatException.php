<?php

namespace Haikiri\MikBiLL\Exception;

use LogicException;

class VoucherCardFormatException extends LogicException
{
	public function __construct(string $message = "Неверный формат ваучера", int $code = -30, $previous = null)
	{
		parent::__construct($message, $code, $previous);
	}

}
