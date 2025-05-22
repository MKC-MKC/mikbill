<?php

namespace Haikiri\MikBiLL\Cabinet\Auth\Phone;

use Haikiri\MikBiLL\ResponseWrapper;

class PhoneOtpModels extends ResponseWrapper
{

	/**
	 * Метод возвращает UID клиента.
	 *
	 * @return int|null
	 */
	public function getUserId(): int|null
	{
		return $this->getData("uid");
	}

	/**
	 * Метод возвращает токен клиента.
	 *
	 * @return string|null
	 */
	public function getUserToken(): string|null
	{
		return $this->getData("token");
	}

}
