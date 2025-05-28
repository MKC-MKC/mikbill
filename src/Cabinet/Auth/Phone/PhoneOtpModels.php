<?php

namespace Haikiri\MikBiLL\Cabinet\Auth\Phone;

use Haikiri\MikBiLL\ResponseWrapper;

class PhoneOtpModels extends ResponseWrapper
{

	/**
	 * Метод возвращает UID клиента.
	 *
	 * @return int
	 */
	public function getUserId(): int
	{
		return (int)$this->getData("uid");
	}

	/**
	 * Метод возвращает токен клиента.
	 *
	 * @return string
	 */
	public function getUserToken(): string
	{
		return (string)$this->getData("token");
	}

}
