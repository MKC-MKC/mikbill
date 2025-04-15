<?php

namespace Haikiri\MikBiLL\Exception;

use Exception;

/** Отбрасываем исключение все остальные исключения MikBiLL. */
class BillApiException extends Exception
{
	public function __construct(string $message = "Unknown error", int $code = 0)
	{
		parent::__construct($message, $code);
	}

}