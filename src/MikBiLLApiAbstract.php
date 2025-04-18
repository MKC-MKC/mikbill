<?php

declare(strict_types=1);

namespace Haikiri\MikBiLL;

use Exception;

abstract class MikBiLLApiAbstract implements MikBiLLApiInterface
{
	protected string $url;
	protected string $key;
	protected ?string $token = null;
	public static bool $debug = false;
	public Billing $billing;
	public Cabinet $cabinet;

	public function __construct(string $url, string $key)
	{
		$this->url = $url;
		$this->key = $key;
		$this->billing = new Billing($this);
		$this->cabinet = new Cabinet($this);
	}

	/**
	 * Метод отправки запроса на сервер MikBiLL API.
	 *
	 * @param $uri
	 * @param $method
	 * @param $params
	 * @param $sign
	 * @param $token
	 */
	abstract public function sendRequest($uri, $method, $params, $sign, $token);

	/**
	 * Метод устанавливает токен пользователя.
	 *
	 * @param string|null $token
	 * @return void
	 */
	public function setUserToken($token): void
	{
		$this->token = $token;
	}

	/**
	 * Метод возвращает токен пользователя.
	 *
	 * @return string
	 */
	public function getUserToken(): string
	{
		return $this->token ?? "";
	}

	/**
	 * Метод валидации ответа JSON.
	 *
	 * @param mixed $json
	 * @param bool|null $asArray
	 * @param int $depth
	 * @param int $flags
	 * @return object|array
	 * @throws Exception
	 */
	public static function validate(mixed $json, ?bool $asArray = null, int $depth = 512, int $flags = 0): object|array
	{
		if (!is_string($json)) throw new Exception("Invalid response from the server: \$json is not a string");
		$result = json_decode($json, $asArray, $depth, $flags);
		if (self::$debug) error_log(PHP_EOL . "**********" . PHP_EOL . var_export($result, true));
		if (json_last_error() !== JSON_ERROR_NONE) throw new Exception(json_last_error_msg(), json_last_error());
		return $result;
	}

}
