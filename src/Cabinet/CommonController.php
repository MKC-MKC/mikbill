<?php

namespace Haikiri\MikBiLL\Cabinet;

use Haikiri\MikBiLL\Exception;
use Haikiri\MikBiLL\MikBiLLApiInterface;

class CommonController
{
	protected MikBiLLApiInterface $billInterface;

	public function __construct(MikBiLLApiInterface $interface)
	{
		$this->billInterface = $interface;
	}

	/**
	 * Метод возвращает IP клиента относительно web-сервера.
	 *
	 * @see https://documenter.getpostman.com/view/5969645/TVCfXTtK#e15b3e31-61c6-4eea-9b2c-b32ce49d09a3
	 * @return object
	 * @noinspection SpellCheckingInspection
	 * @throws Exception\BillApiException|Exception\UnauthorizedException
	 */
	public function getIp(): object
	{
		$response = $this->billInterface->sendRequest(
			uri: "/api/v1/cabinet/getip",
			method: "GET",
			token: $this->billInterface->getUserToken(),
		);
		return new Common\GetIpModel($response["data"] ?? []);
	}

	/**
	 * Метод возвращает время с backend`а
	 *
	 * @see https://documenter.getpostman.com/view/5969645/TVCfXTtK#590cf34a-1467-4199-9406-45458d5fde06
	 * @return object
	 * @noinspection SpellCheckingInspection
	 * @throws Exception\BillApiException|Exception\UnauthorizedException
	 */
	public function getDate(): object
	{
		$response = $this->billInterface->sendRequest(
			uri: "/api/v1/cabinet/serverdate",
			method: "GET",
			token: $this->billInterface->getUserToken(),
		);
		return new Common\GetServerDateModel($response["data"] ?? []);
	}

	/**
	 * Метод возвращает конфигурацию.
	 * Нет планов по реализации моделей для данного API метода.
	 * Используйте ->getAsArray() для получения массива данных.
	 *
	 * @see https://documenter.getpostman.com/view/5969645/TVCfXTtK#8313a870-e586-426c-80b4-b646316bc533
	 * @return object
	 * @throws Exception\BillApiException|Exception\UnauthorizedException
	 */
	public function getConfig(): object
	{
		$response = $this->billInterface->sendRequest(
			uri: "/api/v1/cabinet/config",
			method: "GET",
			token: $this->billInterface->getUserToken(),
		);
		return new Common\GetConfig($response["data"] ?? []);
	}

	/**
	 * Метод возвращает версию MikBiLL.
	 *
	 * @see https://documenter.getpostman.com/view/5969645/TVCfXTtK#ef5cb672-9695-4c1e-a4a6-e10e0e9489c7
	 * @return string|null
	 * @throws Exception\BillApiException|Exception\UnauthorizedException
	 */
	public function getVersion(): ?string
	{
		$response = $this->billInterface->sendRequest(
			uri: "/api/v1/cabinet/version",
			method: "GET",
			token: $this->billInterface->getUserToken(),
		);
		return isset($response["data"]) ? (string)$response["data"] : null;
	}

	/**
	 * Метод возвращает контактные данные организации.
	 *
	 * @see https://documenter.getpostman.com/view/5969645/TVCfXTtK#2949d3f0-a201-477b-9de5-cee4566b61ec
	 * @return object
	 * @throws Exception\BillApiException|Exception\UnauthorizedException
	 */
	public function getContact(): object
	{
		$response = $this->billInterface->sendRequest(
			uri: "/api/v1/cabinet/contact",
			method: "GET",
			token: $this->billInterface->getUserToken(),
		);
		return new Common\GetCompanyInfoModel($response["data"] ?? []);
	}

	/**
	 * Метод вообще что-то возвращает?
	 *
	 * @see https://documenter.getpostman.com/view/5969645/TVCfXTtK#d8fc182c-2200-4a06-80df-f12d54e94b3b
	 * @return object
	 * @throws Exception\BillApiException|Exception\UnauthorizedException
	 */
	public function getMenu(): object
	{
		$response = $this->billInterface->sendRequest(
			uri: "/api/v1/cabinet/menu",
			method: "GET",
			token: $this->billInterface->getUserToken(),
		);
		return new Common\GetMenu($response["data"] ?? []);
	}

}
