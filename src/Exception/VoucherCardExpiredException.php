<?php

namespace Haikiri\MikBiLL\Exception;

use LogicException;

class VoucherCardExpiredException extends LogicException
{
	public function __construct(string $message = "Срок ваучера истек", int $code = -34, $previous = null)
	{
		parent::__construct($message, $code, $previous);
	}

}
