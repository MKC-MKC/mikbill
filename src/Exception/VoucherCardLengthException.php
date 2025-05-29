<?php

namespace Haikiri\MikBiLL\Exception;

use LogicException;

class VoucherCardLengthException extends LogicException
{
	public function __construct(string $message = "Ошибка длинны ваучера", int $code = -29, $previous = null)
	{
		parent::__construct($message, $code, $previous);
	}

}
