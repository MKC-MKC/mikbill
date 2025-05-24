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
	 * Метод возвращает информацию по услуге "Кредит".
	 *
	 * @return Services\Credit
	 * @throws Exception\BillApiException
	 * @see https://documenter.getpostman.com/view/5969645/TVCfXTtK#6ce52e21-a697-4585-9141-070fe54f44d2
	 */
	public function getCredit(): object
	{
		$response = $this->billInterface->sendRequest(
			uri: "/api/v1/cabinet/user/services/credit",
			method: "GET",
			token: $this->billInterface->getUserToken(),
		);

		return new Services\Credit($response->getData());
	}

	/**
	 * Метод подключает услугу "Кредит".
	 *
	 * @return boolean
	 * @throws Exception\AlreadyActivatedException|Exception\BillApiException
	 * @see https://documenter.getpostman.com/view/5969645/TVCfXTtK#80be6c2e-663a-47f2-8243-5822f250571d
	 */
	public function activateCredit(): bool
	{
		$response = $this->billInterface->sendRequest(
			uri: "/api/v1/cabinet/user/services/credit",
			method: "POST",
			token: $this->billInterface->getUserToken(),
		);

		return $response->isSuccess();
	}

	/**
	 * Метод возвращает информацию по услуге "Заморозка".
	 *
	 * @return Services\Freeze
	 * @throws Exception\BillApiException
	 * @see https://documenter.getpostman.com/view/5969645/TVCfXTtK#8265de59-ab3c-4b82-a391-384d2c384b38
	 */
	public function getFreeze(): object
	{
		$response = $this->billInterface->sendRequest(
			uri: "/api/v1/cabinet/user/services/freeze",
			method: "GET",
			token: $this->billInterface->getUserToken(),
		);

		return new Services\Freeze($response->getData());
	}

	/**
	 * Метод подключает услугу "Заморозка".
	 *
	 * @param bool $now
	 * @param mixed|null $dateStart
	 * @param mixed|null $dateStop
	 * @param mixed $freezeDoEver
	 * @param mixed $fixedMonthNum
	 * @return bool
	 * @throws Exception\BillApiException
	 * @see https://documenter.getpostman.com/view/5969645/TVCfXTtK#fc7bfdfd-ecea-41c6-b39f-46767380a186
	 */
	public function activateFreeze(
		bool  $now = true,
		mixed $dateStart = null, # Y-m-d
		mixed $dateStop = null, # Y-m-d
		mixed $freezeDoEver = null,
		mixed $fixedMonthNum = null,
	): bool
	{
		$params = [
			"now" => $now,
			"activate" => 1,
			"date_start" => $dateStart, # Y-m-d
			"date_stop" => $dateStop, # Y-m-d
			"freeze_do_ever" => $freezeDoEver,
			"fixed_month_num" => $fixedMonthNum,
		];

		$response = $this->billInterface->sendRequest(
			uri: "/api/v1/cabinet/user/services/freeze",
			method: "POST",
			params: $params,
			token: $this->billInterface->getUserToken(),
		);

		return $response->isSuccess();
	}

	/**
	 * Метод отключает услугу "Заморозка".
	 *
	 * @return bool
	 * @throws Exception\AlreadyDeactivatedException|Exception\BillApiException
	 * @see https://documenter.getpostman.com/view/5969645/TVCfXTtK#5d4f20d4-0dd5-4509-9a58-d6d3621c886c
	 */
	public function deactivateFreeze(): bool
	{
		$params = [
			"activate" => 0,
		];

		$response = $this->billInterface->sendRequest(
			uri: "/api/v1/cabinet/user/services/freeze",
			method: "POST",
			params: $params,
			token: $this->billInterface->getUserToken(),
		);

		return $response->isSuccess();
	}

	/**
	 * Метод возвращает информацию по услуге "Турбо".
	 *
	 * @return Services\Turbo
	 * @throws Exception\AlreadyActivatedException|Exception\BillApiException
	 * @see https://documenter.getpostman.com/view/5969645/TVCfXTtK#e337f28a-4cdb-4573-909e-f90d1b986019
	 */
	public function getTurbo(): object
	{
		$response = $this->billInterface->sendRequest(
			uri: "/api/v1/cabinet/user/services/turbo",
			method: "GET",
			token: $this->billInterface->getUserToken(),
		);

		return new Services\Turbo($response->getData());
	}

	/**
	 * Метод подключает услугу "Турбо".
	 *
	 * @return bool
	 * @throws Exception\AlreadyActivatedException|Exception\BillApiException
	 * @see https://documenter.getpostman.com/view/5969645/TVCfXTtK#eed97b68-3208-4273-9626-52db2e2de7dd
	 */
	public function activateTurbo(): bool
	{
		$response = $this->billInterface->sendRequest(
			uri: "/api/v1/cabinet/user/services/turbo",
			method: "POST",
			token: $this->billInterface->getUserToken(),
		);

		return $response->isSuccess();
	}

}
