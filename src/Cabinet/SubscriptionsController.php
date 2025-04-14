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
	 * Метод возвращает модель доступных подписок на данный момент абоненту к выбранному сервису.
	 *
	 * @see https://documenter.getpostman.com/view/5969645/TVCfXTtK#aa0c7b39-2525-44a7-a1f6-d8aa7f9b8677
	 * @param string $service - Название подписки. Используйте "other", "MegoGo", "wink" и.т.д. Актуальный список не нашёл, смотри ссылку выше.
	 * @return Subscriptions\Subscription
	 * @throws InvalidTokenException
	 */
	public function getSubscriptions(string $service = "other"): Subscriptions\Subscription {
		if (empty($this->billInterface->getUserToken())) throw new InvalidTokenException("The token was not found: The storage with token is empty.");
		$response = $this->billInterface->sendRequest(
			uri:		"/api/v1/cabinet/user/subscriptions/" . trim(strtolower($service), "/"),
			method:		"GET",
			token:		$this->billInterface->getUserToken(),
		);
		return new Subscriptions\Subscription($response["data"] ?? []);
	}

	/**
	 * Метод выполняет подписку или отписку клиента от услуги используя токен как идентификатор.
	 *
	 * @see https://documenter.getpostman.com/view/5969645/TVCfXTtK#b7e82f1a-c4d7-4c9b-a126-a23d67de8c6f
	 * @param int $id - 123 - ID подписки;
	 * @param int $activate - 0 - для отписки; 1 - для подписки;
	 * @param string $service - Название подписки. Используйте "other", "MegoGo", "wink" и.т.д. Актуальный список не нашёл, смотри ссылку выше.
	 * @return bool
	 * @throws InvalidTokenException
	 */
	public function setSubscription(int $id = 123, int $activate = 0, string $service = "other"): bool {
		if (empty($this->billInterface->getUserToken())) throw new InvalidTokenException("The token was not found: The storage with token is empty.");
		$params = [
			"id"		=>	$id,
			"activate"	=>	$activate,
		];
		$response = $this->billInterface->sendRequest(
			uri:		"/api/v1/cabinet/user/subscriptions/" . trim(strtolower($service), "/"),
			params:		$params,
			token:		$this->billInterface->getUserToken(),
		);
		return isset($response["success"]) && $response["success"] == 1;
	}

	/**
	 * TODO: Временный Fallback метод из-за изначально-нелогичного названия метода.
	 * @use self::setSubscription
	 * @param mixed ...$args
	 * @return bool
	 * @throws InvalidTokenException
	 * @deprecated Используй метод setSubscription();
	 */
	public function setSubscriptions(...$args): bool {
		return $this->setSubscription(...$args);
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