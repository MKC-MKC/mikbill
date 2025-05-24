<?php

namespace Haikiri\MikBiLL\Cabinet;

use Haikiri\MikBiLL\Exception;
use Haikiri\MikBiLL\MikBiLLApiInterface;

class SubscriptionsController
{
	protected MikBiLLApiInterface $billInterface;

	public function __construct(MikBiLLApiInterface $interface)
	{
		$this->billInterface = $interface;
	}

	/**
	 * Метод возвращает модель доступных подписок middleware.
	 *
	 * @param string $service - Название сервиса middleware: "MegoGo", "wink" и.т.д. Актуальный список смотри ссылку выше.
	 * @return Subscriptions\Subscription
	 * @throws Exception\BillApiException
	 * @see https://documenter.getpostman.com/view/5969645/TVCfXTtK#aa0c7b39-2525-44a7-a1f6-d8aa7f9b8677
	 */
	public function getSubscriptions(string $service = "other"): object
	{
		$response = $this->billInterface->sendRequest(
			uri: "/api/v1/cabinet/user/subscriptions/" . trim(strtolower($service), "/"),
			method: "GET",
			token: $this->billInterface->getUserToken(),
		);

		return new Subscriptions\Subscription($response->getData());
	}

	/**
	 * Метод выполняет подписку или отписку клиента от услуги по ID относительно middleware.
	 *
	 * @param $id - 123 - ID подписки;
	 * @param int|bool $activate - 0 - для отписки; 1 - для подписки;
	 * @param string $service - Название сервиса middleware: "MegoGo", "wink" и.т.д. Актуальный список смотри ссылку выше.
	 * @return bool
	 * @throws Exception\BillApiException
	 * @see https://documenter.getpostman.com/view/5969645/TVCfXTtK#b7e82f1a-c4d7-4c9b-a126-a23d67de8c6f
	 */
	public function setSubscription($id, int|bool $activate = 0, string $service = "other"): bool
	{
		$params = [
			"id" => $id,
			"activate" => (int)$activate,
		];

		$response = $this->billInterface->sendRequest(
			uri: "/api/v1/cabinet/user/subscriptions/" . trim(strtolower($service), "/"),
			params: $params,
			token: $this->billInterface->getUserToken(),
		);

		return $response->isSuccess();
	}

	/**
	 * Метод возвращает список всех Middleware.
	 *
	 * @return Subscriptions\Middleware
	 * @throws Exception\BillApiException
	 * @see https://documenter.getpostman.com/view/5969645/TVCfXTtK#43ddf0d2-722b-4c1d-b7b6-050c5452dccb
	 */
	public function getMiddlewares(): object
	{
		$response = $this->billInterface->sendRequest(
			uri: "/api/v1/cabinet/user/subscriptions/middlewares",
			method: "GET",
			token: $this->billInterface->getUserToken(),
		);

		return new Subscriptions\Middleware($response->getData());
	}

	/**
	 * Метод возвращает список групп и их дополнительных подписок (не привязанных к middleware).
	 *
	 * @return Subscriptions\Additional
	 * @throws Exception\BillApiException
	 * @see https://documenter.getpostman.com/view/5969645/TVCfXTtK#df73309e-ae0a-453d-938d-966874227ee0
	 */
	public function getAdditional(): object
	{
		$response = $this->billInterface->sendRequest(
			uri: "/api/v1/cabinet/user/subscriptions/additional",
			method: "GET",
			token: $this->billInterface->getUserToken(),
		);

		return new Subscriptions\Additional($response->getData());
	}

	/**
	 * Метод выполняет подписку или отписку клиента от услуги используя ID услуги и токен как идентификатор.
	 *
	 * @param $id - 123 - ID подписки;
	 * @param int|bool $activate - 0 - для отписки; 1 - для подписки;
	 * @return bool
	 * @throws Exception\BillApiException
	 * @see https://documenter.getpostman.com/view/5969645/TVCfXTtK#828c0e2c-6bb8-4f90-9cbb-40798ab644a2
	 */
	public function setAdditional($id, int|bool $activate = 0): bool
	{
		$params = [
			"id" => $id,
			"activate" => (int)$activate,
		];

		$response = $this->billInterface->sendRequest(
			uri: "/api/v1/cabinet/user/subscriptions/additional",
			params: $params,
			token: $this->billInterface->getUserToken(),
		);

		return $response->isSuccess();
	}

}
