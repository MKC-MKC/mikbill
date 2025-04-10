<?php

declare(strict_types=1);

namespace Haikiri\MikBiLL;

abstract class MikBiLLApiAbstract implements MikBiLLApiInterface {
	protected		string				$url;
	protected		string				$key;
	protected		?string				$token = null;
	public			static bool			$debug = false;
	public			Billing				$billing;
	public			Cabinet				$cabinet;

	public function __construct(string $url, string $key) {
		$this->url		=	$url;
		$this->key		=	$key;
		$this->billing	=	new Billing($this);
		$this->cabinet	=	new Cabinet($this);
	}

	/**
	 * Метод отправки запроса на сервер MikBiLL API.
	 *
	 * @param string $uri
	 * @param string $method
	 * @param array $params
	 * @param bool $sign
	 * @param string|null $token
	 * @return array|null
	 * @throws Exception\InvalidJsonException
	 */
	abstract public function sendRequest(string $uri, string $method = "POST", array $params = [], bool $sign = false, ?string $token = null): ?array;

	/**
	 * Метод устанавливает токен пользователя.
	 *
	 * @param string|null $token
	 * @return void
	 */
	public function setUserToken(?string $token): void {
		$this->token = $token;
	}

	/**
	 * Метод возвращает токен пользователя.
	 *
	 * @return string|null
	 */
	public function getUserToken(): ?string {
		return $this->token;
	}

	/**
	 * Метод валидации ответа JSON.
	 *
	 * @param mixed $json
	 * @param bool|null $asArray
	 * @param int $depth
	 * @param int $flags
	 * @return object|array
	 * @throws Exception\InvalidJsonException
	 */
	public static function validate(mixed $json, ?bool $asArray = null, int $depth = 512, int $flags = 0): object|array {
		if (!is_string($json)) throw new Exception\InvalidJsonException("Invalid response from the server: \$json is not a string");
		$result = json_decode($json, $asArray, $depth, $flags);
		if (self::$debug) error_log(PHP_EOL . "**********" . PHP_EOL . var_export($result, true));
		return json_last_error() != JSON_ERROR_NONE ? throw new Exception\InvalidJsonException(json_last_error_msg(), json_last_error()) : $result;
	}
}