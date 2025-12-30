<?php

namespace Haikiri\MikBiLL;

use LogicException;

abstract class MikBiLLApiAbstract implements MikBiLLApiInterface
{
	protected string $url;
	protected string $key;
	protected string|null $token = null;
	public static bool $debug;
	public Billing $billing;
	public Cabinet $cabinet;

	public function __construct(string $url, string $key, $debug = false)
	{
		$this->url = $url;
		$this->key = $key;
		$this->billing = new Billing($this);
		$this->cabinet = new Cabinet($this);
		self::$debug = filter_var($debug, FILTER_VALIDATE_BOOLEAN);
	}

	/**
	 * Метод отправки запроса на сервер MikBiLL API.
	 */
	abstract public function sendRequest($uri, $method, $params, $sign, $token);

	/**
	 * Метод устанавливает токен пользователя.
	 *
	 * @param string|null $token
	 * @return static
	 */
	public function setUserToken($token): static
	{
		$this->token = $token;

		return $this;
	}

	/**
	 * Метод возвращает токен пользователя.
	 *
	 * @return string
	 */
	public function getUserToken(): string
	{
		return (string)$this->token ?? "";
	}

	/**
	 * Метод валидации ответа JSON.
	 *
	 * @param mixed $json
	 * @param bool|null $asArray
	 * @param int $depth
	 * @param int $flags
	 * @return object|array
	 * @throws LogicException
	 */
	public static function validate(mixed $json, ?bool $asArray = null, int $depth = 512, int $flags = 0): object|array
	{
		if (!is_string($json)) throw new LogicException("Invalid response from the server: \$json is not a string");
		$result = json_decode($json, $asArray, $depth, $flags);
		if (self::$debug) error_log(PHP_EOL . "**********" . PHP_EOL . var_export($result, true));
		if (json_last_error() !== JSON_ERROR_NONE) throw new LogicException(json_last_error_msg(), json_last_error());
		return $result;
	}

}
