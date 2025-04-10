<?php

declare(strict_types=1);

namespace Haikiri\MikBiLL\Cabinet;

use Haikiri\MikBiLL\MikBiLLApiInterface;

class AuthController implements AuthControllerInterface {
	protected		MikBiLLApiInterface				$billInterface;

	public function __construct(MikBiLLApiInterface $interface) {
		$this->billInterface = $interface;
	}

	/**
	 * Авторизация клиента. Получение токена.
	 *
	 * @see https://documenter.getpostman.com/view/5969645/TVCfXTtK#a19e1a83-9c70-4a3c-97ea-56c1ab3f7cbb
	 * @param string $login
	 * @param string $pass
	 * @return Auth\Login\LoginModels
	 */
	public function login($login, $pass): Auth\Login\LoginModels {
		$params = [
			"login"		=>	$login,
			"password"	=>	$pass,
		];

		$response = $this->billInterface->sendRequest(
			uri:		"/api/v1/cabinet/auth/login",
			params:		$params,
		);
		return new Auth\Login\LoginModels($response["data"] ?? []);
	}

	/**
	 * Авторизация по телефону. TODO: Нет возможности проверить работоспособность метода.
	 *
	 * @see https://documenter.getpostman.com/view/5969645/TVCfXTtK#a65b8db9-0c0c-4227-a1f6-8109eedfe61a
	 * @param string $phone # Например: '380934708280'
	 * @return array|null
	 */
	public function phone($phone): ?array {
		$params = [
			"phone"		=>	$phone,
		];

		return $this->billInterface->sendRequest(uri: "/api/v1/cabinet/auth/phone", params: $params);
	}

	/**
	 * Авторизация по телефону.
	 *
	 * @see https://documenter.getpostman.com/view/5969645/TVCfXTtK#0c62d445-3b55-4732-8b37-88aae1bb0773
	 * @param string $otp # Например: '71-49-05-18' - Код из SMS
	 * @return Auth\Phone\PhoneOtpModels
	 */
	public function PhoneOtp($otp): Auth\Phone\PhoneOtpModels {
		$params = [
			"otp"	=>	$otp,
		];

		$response = $this->billInterface->sendRequest(
			uri:		"/api/v1/cabinet/auth/phone/otp",
			params:		$params,
		);
		return new Auth\Phone\PhoneOtpModels($response["data"] ?? []);
	}

}