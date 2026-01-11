<?php

namespace Haikiri\MikBiLL\Cabinet;

use Haikiri\MikBiLL\Exception;
use Haikiri\MikBiLL\MikBiLLApiInterface;
use Haikiri\MikBiLL\Response;

class AuthController
{
	protected MikBiLLApiInterface $billInterface;

	public function __construct(MikBiLLApiInterface $interface)
	{
		$this->billInterface = $interface;
	}

	/**
	 * Авторизация клиента. Получение токена.
	 *
	 * @param string $login
	 * @param string $pass
	 * @return Auth\Login\Login
	 * @throws Exception\BillApiException
	 * @see https://documenter.getpostman.com/view/5969645/TVCfXTtK#a19e1a83-9c70-4a3c-97ea-56c1ab3f7cbb
	 */
	public function login(string $login, string $pass): object
	{
		$params = [
			"login" => $login,
			"password" => $pass,
		];

		$response = $this->billInterface->sendRequest(
			uri: "/api/v1/cabinet/auth/login",
			params: $params,
		);

		return new Auth\Login\Login($response->getData());
	}

	/**
	 * Авторизация по телефону.
	 *
	 * @param int|string $phone # Например: '380934708280'
	 * @return Response
	 * @throws Exception\BillApiException
	 * @see https://documenter.getpostman.com/view/5969645/TVCfXTtK#a65b8db9-0c0c-4227-a1f6-8109eedfe61a
	 */
	public function phone(int|string $phone): Response
	{
		$params = [
			"phone" => $phone,
		];

		return $this->billInterface->sendRequest(
			uri: "/api/v1/cabinet/auth/phone",
			params: $params,
		);
	}

	/**
	 * Авторизация по телефону.
	 *
	 * @param int|string $otp # Например: '71-49-05-18' - Код из SMS
	 * @return Auth\Phone\PhoneOtp
	 * @throws Exception\BillApiException
	 * @see https://documenter.getpostman.com/view/5969645/TVCfXTtK#0c62d445-3b55-4732-8b37-88aae1bb0773
	 */
	public function phoneOtp(int|string $otp): object
	{
		$params = [
			"otp" => $otp,
		];

		$response = $this->billInterface->sendRequest(
			uri: "/api/v1/cabinet/auth/phone/otp",
			params: $params,
		);

		return new Auth\Phone\PhoneOtp($response->getData());
	}

}
