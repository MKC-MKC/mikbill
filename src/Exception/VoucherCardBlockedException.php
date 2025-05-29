<?php

namespace Haikiri\MikBiLL\Exception;

use LogicException;

class VoucherCardBlockedException extends LogicException
{
	public function __construct(string $message = "Ваучер заблокирован", int $code = -32, $previous = null)
	{
		parent::__construct($message, $code, $previous);
	}

}
