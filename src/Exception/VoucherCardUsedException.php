<?php

namespace Haikiri\MikBiLL\Exception;

use LogicException;

class VoucherCardUsedException extends LogicException
{
	public function __construct(string $message = "Ваучер уже был активирован", int $code = -33, $previous = null)
	{
		parent::__construct($message, $code, $previous);
	}

}
