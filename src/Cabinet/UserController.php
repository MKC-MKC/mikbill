<?php

declare(strict_types=1);

namespace Haikiri\MikBiLL\Cabinet;

use Haikiri\MikBiLL\Exception;
use Haikiri\MikBiLL\MikBiLLApiInterface;

class UserController {
	protected		MikBiLLApiInterface				$billInterface;

	public function __construct(MikBiLLApiInterface $interface) {
		$this->billInterface = $interface;
	}

	/**
	 * Метод возвращает модель с данными клиента.
	 *
	 * @see https://documenter.getpostman.com/view/5969645/TVCfXTtK#de3b335f-628e-418d-bf7d-294afec72f82
	 * @return User\UserModels
	 * @throws Exception\UnauthorizedException|Exception\BillApiException
	 */
	public function getUser(): User\UserModels {
		$response = $this->billInterface->sendRequest(uri: "/api/v1/cabinet/user", method: "GET", token: $this->billInterface->getUserToken());
		return new User\UserModels($response["data"] ?? []);
	}

}