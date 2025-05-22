<?php

namespace Haikiri\MikBiLL\Cabinet;

use Haikiri\MikBiLL\Exception;
use Haikiri\MikBiLL\MikBiLLApiInterface;

class ServicesController
{
	protected MikBiLLApiInterface $billInterface;

	public function __construct(MikBiLLApiInterface $interface)
	{
		$this->billInterface = $interface;
	}

	/**
	 * Метод возвращает информацию о кредитах.
	 *
	 * @return Services\Credit
	 * @throws Exception\BillApiException
	 */
	public function getCredit(): Services\Credit
	{
		$response = $this->billInterface->sendRequest(
			uri: "/api/v1/cabinet/user/services/credit",
			method: "GET",
			token: $this->billInterface->getUserToken(),
		);

		return new Services\Credit($response->getData());
	}

	/**
	 * Метод устанавливает кредит.
	 *
	 * @return boolean
	 * @throws Exception\AlreadyActivatedException|Exception\BillApiException
	 */
	public function setCredit(): bool
	{
		$response = $this->billInterface->sendRequest(
			uri: "/api/v1/cabinet/user/services/credit",
			method: "POST",
			token: $this->billInterface->getUserToken(),
		);

		return $response->isSuccess();
	}

}
