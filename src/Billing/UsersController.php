<?php

declare(strict_types=1);

namespace Haikiri\MikBiLL\Billing;

use Haikiri\MikBiLL\MikBiLLApiInterface;

class UsersController implements UsersControllerInterface {
	protected		MikBiLLApiInterface				$billInterface;

	public function __construct(MikBiLLApiInterface $interface) {
		$this->billInterface = $interface;
	}

	/**
	 * Метод поиска абонентов в Billing по критериям.
	 *
	 * Пример использования:
	 * $this->searchUser(key: "local_ip", value: "10.0.0.2", operator: "="); # Это найдёт всех пользователей с local_ip равным 10.0.0.2.
	 *
	 * @see https://documenter.getpostman.com/view/5969645/TVCfXTtK#f0e8660b-bc5b-42d9-99ad-a53c866b844e
	 * @param string $key         - Возможные ключи: ['user', 'uid', 'state', 'gid', 'deposit', 'credit', и.т.д...]
	 * @param string $value       - Значение по которому будет производиться поиск.
	 * @param string $operator    - Возможные операторы: ['<', '=', '>', '>=', '!='] или ['меньше', 'равно', 'больше', 'больше или равно', 'не равно'].
	 * @return UsersSearchController
	 */
	public function searchUser(string $key = "uid", string $value = "1", string $operator = "="): UsersSearchController {
		$params = [
			"field"		=>	$key,
			"operator"	=>	$operator,
			"value"		=>	$value,
		];

		$response = $this->billInterface->sendRequest(
			uri: "/api/v1/billing/users/search",
			params: $params,
			sign: true
		);
		return new UsersSearchController($response["data"] ?? []);
	}

	/**
	 * Метод с помощью которого можно авторизовать пользователя (получить token) по UID для Cabinet API.
	 *
	 * @see https://documenter.getpostman.com/view/5969645/TVCfXTtK#925498e8-df53-48e7-86c0-69ca6982ad44
	 * @param string $uid
	 * @return array|null
	 */
	public function getUserToken(string $uid): ?string {
		$params = [
			"uid"	=>	$uid
		];

		$response = $this->billInterface->sendRequest(
			uri: "/api/v1/billing/users/token",
			params: $params,
			sign: true
		);

		return $response["data"]["token"] ?? null;
	}

	/**
	 * Метод с помощью которого можно выкинуть пользователя из on-line по UID.
	 *
	 * @use https://documenter.getpostman.com/view/5969645/TVCfXTtK#e0a2b1c3-4d8f-4a6b-9c7d-0e1f2a3b5c8e
	 * @param string $uid
	 * @return array|null
	 */
	public function kickUser(string $uid): ?array {
		$params = [
			"uid"	=>	$uid,
		];

		return $this->billInterface->sendRequest(
			uri: "/api/v1/billing/users/kick",
			params: $params,
			sign: true
		);
	}

	/**
	 * @deprecated - Не удалось найти документацию. Метод найден в библиотеке 'kagatan/mb-client-api'.
	 *
	 * @see https://github.com/kagatan/mb-client-api/blob/77fea126b42a701563646a99fa439d313ac39b39/src/ClientAPI.php#L126
	 * @param $uid
	 * @param $user_id
	 * @return array|null
	 */
	public function bindUser($uid, $user_id): ?array {
		$params = [
			"uid"		=>	$uid,
			"user_id"	=>	$user_id,
		];

		return $this->billInterface->sendRequest("/api/v1/billing/users/bind", "POST", $params, true);
	}

}