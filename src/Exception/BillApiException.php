<?php

namespace Haikiri\MikBiLL\Exception;

use Exception;

/** Отбрасываем все остальные исключения MikBiLL. */
class BillApiException extends Exception
{
	public function __construct(string $message = "Произошла неизвестная ошибка", int $code = -1, $previous = null)
	{
		parent::__construct($message, $code, $previous);
	}

}
