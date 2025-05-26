<?php

namespace Haikiri\MikBiLL\Exception;

use LogicException;

class SmsSendException extends LogicException
{
	public function __construct(string $message = "Ошибка отправки СМС", int $code = -15)
	{
		parent::__construct($message, $code);
	}

}
