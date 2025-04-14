<?php

namespace Haikiri\MikBiLL\Cabinet;

use Haikiri\MikBiLL\MikBiLLApiInterface;
use Haikiri\MikBiLL\Exception\InvalidTokenException;

class SubscriptionsController {
	protected		MikBiLLApiInterface				$billInterface;

	public function __construct(MikBiLLApiInterface $interface) {
		$this->billInterface = $interface;
	}

	/**
	 * Метод возвращает доступные подписки на данный момент абоненту.
	 *
	 * @see https://documenter.getpostman.com/view/5969645/TVCfXTtK#aa0c7b39-2525-44a7-a1f6-d8aa7f9b8677
	 * @return Subscriptions\OtherController
	 * @throws InvalidTokenException
	 */
	public function getSubscriptions(): Subscriptions\OtherController {
		if (empty($this->billInterface->getUserToken())) throw new InvalidTokenException("The token was not found: The storage with token is empty.");
		$response = $this->billInterface->sendRequest(
			uri:		"/api/v1/cabinet/user/subscriptions/other",
			method:		"GET",
			token:		$this->billInterface->getUserToken(),
		);
		return new Subscriptions\OtherController($response["data"] ?? []);
	}

	/**
	 * Метод выполняет подписку или отписку клиента от услуги используя токен как идентификатор.
	 *
	 * @see https://documenter.getpostman.com/view/5969645/TVCfXTtK#4961fc71-9fb5-4ccf-a1a7-acdc121f329b
	 * @param int $id - 102 - for example;
	 * @param int $activate - 0 - for unsubscribe; 1 - for subscribe;
	 * @return bool
	 * @throws InvalidTokenException
	 */
	public function setSubscriptions(int $id = 102, int $activate = 0): bool {
		if (empty($this->billInterface->getUserToken())) throw new InvalidTokenException("The token was not found: The storage with token is empty.");
		$params = [
			"id"		=>	$id,
			"activate"	=>	$activate,
		];
		$response = $this->billInterface->sendRequest(
			uri:		"/api/v1/cabinet/user/subscriptions/other",
			params:		$params,
			token:		$this->billInterface->getUserToken(),
		);
		return isset($response["success"]) && $response["success"] == 1;
	}

	/**
	 * Метод возвращает список всех Middleware.
	 *
	 * @see https://documenter.getpostman.com/view/5969645/TVCfXTtK#43ddf0d2-722b-4c1d-b7b6-050c5452dccb
	 * @return Subscriptions\Middleware
	 * @throws InvalidTokenException
	 */
	public function getMiddlewares(): Subscriptions\Middleware {
		if (empty($this->billInterface->getUserToken())) throw new InvalidTokenException("The token was not found: The storage with token is empty.");
		$response = $this->billInterface->sendRequest(
			uri:		"/api/v1/cabinet/user/subscriptions/middlewares",
			method:		"GET",
			token:		$this->billInterface->getUserToken(),
		);
		return new Subscriptions\Middleware($response["data"] ?? []);
	}

}