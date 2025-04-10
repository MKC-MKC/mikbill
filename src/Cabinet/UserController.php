<?php

declare(strict_types=1);

namespace Haikiri\MikBiLL\Cabinet;

use Haikiri\MikBiLL\MikBiLLApiInterface;
use Haikiri\MikBiLL\Exception\InvalidTokenException;

class UserController implements UserControllerInterface {
	protected		MikBiLLApiInterface				$billInterface;

	public function __construct(MikBiLLApiInterface $interface) {
		$this->billInterface = $interface;
	}

	/**
	 * Метод возвращает модель с данными клиента.
	 *
	 * @see https://documenter.getpostman.com/view/5969645/TVCfXTtK#de3b335f-628e-418d-bf7d-294afec72f82
	 * @return User\UserModels
	 * @throws InvalidTokenException
	 */
	public function getUser(): User\UserModels {
		if (empty($this->billInterface->getUserToken())) throw new InvalidTokenException("The token was not found: The storage with token is empty.");
		$response = $this->billInterface->sendRequest(uri: "/api/v1/cabinet/user", method: "GET", token: $this->billInterface->getUserToken());
		return new User\UserModels($response["data"] ?? []);
	}

}