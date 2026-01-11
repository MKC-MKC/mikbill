<?php

namespace Haikiri\MikBiLL\Cabinet;

use Haikiri\MikBiLL\Exception\BillApiException;
use Haikiri\MikBiLL\Exception\OverLimitException;
use Haikiri\MikBiLL\Exception\SmsSendException;
use Haikiri\MikBiLL\MikBiLLApiInterface;
use Haikiri\MikBiLL\Response;

class UserController
{
	protected MikBiLLApiInterface $billInterface;
	public const NEXT_MONTH = 1; # В начале нового месяца.
	public const NOW = 0; # Моментально.

	public function __construct(MikBiLLApiInterface $interface)
	{
		$this->billInterface = $interface;
	}

	/**
	 * Метод возвращает модель с данными клиента.
	 *
	 * @see https://documenter.getpostman.com/view/5969645/TVCfXTtK#de3b335f-628e-418d-bf7d-294afec72f82
	 * @return User\User
	 * @throws BillApiException
	 */
	public function getUser(): object
	{
		$response = $this->billInterface->sendRequest(
			uri: "/api/v1/cabinet/user",
			method: "GET",
			token: $this->billInterface->getUserToken(),
		);

		return new User\User($response->getData());
	}

	/**
	 * Напомнить пароль. Клиенту будет отправлено сообщение.
	 *
	 * @param $phone
	 * @return bool
	 * @throws SmsSendException|OverLimitException|BillApiException
	 * @see https://documenter.getpostman.com/view/5969645/TVCfXTtK#e3ef592b-f6f8-4cc3-9420-8d90303653fa
	 */
	public function restorePassword($phone): bool
	{
		$params = [
			"phone" => $phone,
		];

		$response = $this->billInterface->sendRequest(
			uri: "/api/v1/cabinet/user/password/restore",
			method: "POST",
			params: $params,
			token: $this->billInterface->getUserToken(),
		);

		return $response->isSuccess();
	}

	/**
	 * Изменить пароль клиента.
	 *
	 * @param string $old
	 * @param string $new
	 * @return bool
	 * @throws BillApiException
	 * @see https://documenter.getpostman.com/view/5969645/TVCfXTtK#8116776e-bf9c-4ef6-a232-09b8547f55c2
	 */
	public function changePassword(string $old, string $new): bool
	{
		$params = [
			"password" => $old,
			"password_new" => $new,
		];

		$response = $this->billInterface->sendRequest(
			uri: "/api/v1/cabinet/user/password/change",
			method: "POST",
			params: $params,
			token: $this->billInterface->getUserToken(),
		);

		return $response->isSuccess();
	}

	/**
	 * Сменить тарифный план абоненту.
	 *
	 * @param $gid
	 * @param $password
	 * @param int|bool $next_month
	 * @return Response
	 * @throws BillApiException
	 * @see https://documenter.getpostman.com/view/5969645/TVCfXTtK#655108d0-c999-457f-b01c-0ef4faf3747d
	 */
	public function changePacket($gid, $password = null, int|bool $next_month = self::NOW): Response
	{
		$params = [
			"gid" => (int)$gid,
			"password" => $password,
			"from_next_month" => (int)$next_month,
		];

		return $this->billInterface->sendRequest(
			uri: "/api/v1/cabinet/user/packet",
			method: "POST",
			params: $params,
			token: $this->billInterface->getUserToken(),
		);
	}

}
