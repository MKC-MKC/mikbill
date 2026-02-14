<?php

declare(strict_types=1);

namespace Haikiri\MikBiLL;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Haikiri\MikBiLL\Exception\BillApiException;
use Throwable;

class MikBiLLApi extends MikBiLLApiAbstract
{
	private Client $client;

	public function __construct(string $url, string $key, private string|null $proxy = "", $debug = false)
	{
		parent::__construct($url, $key, $debug);
		$this->client = new Client([
			"timeout" => 10,
			"http_errors" => false,
		]);
	}

	/**
	 * Метод отправки запроса на сервер MikBiLL API.
	 *
	 * @param string $uri
	 * @param string $method
	 * @param array $params
	 * @param bool $sign
	 * @param string|null $token
	 * @return Response
	 * @throws Exception\BillApiException
	 */
	public function sendRequest($uri, $method = "POST", $params = [], $sign = false, $token = null): Response
	{
		$headers = [];
		$options = [];

		if ($sign) {
			$params["salt"] = self::generateSalt();
			$params["sign"] = hash_hmac("sha512", $params["salt"], $this->key);
		} else {
			if ($token === "") throw new Exception\UnauthorizedException("The token was not found: The storage with token is empty.", -999);
			$headers["Authorization"] = $token;
		}

		$options["headers"] = $headers;

		if (strtoupper($method) == "POST") {
			$options["form_params"] = $params;
		} elseif (!empty($params)) {
			$options["query"] = $params;
		}

		try {
			if (!empty($this->proxy)) $options["proxy"] = $this->proxy;
			$url = rtrim($this->url, "/") . "/" . ltrim($uri, "/");
			$response = $this->client->request($method, $url, $options);
			$body = $response->getBody()->getContents();
		} catch (GuzzleException $ex) {
			throw new BillApiException($ex->getMessage(), $ex->getCode(), $ex);
		}

		$validResponse = self::validate($body, true);
		self::billResponseValidate($validResponse);
		return Response::fromResponse($validResponse);
	}

	/**
	 * Метод валидации ответа от Billing API.
	 *
	 * @param array $response
	 * @return void
	 * @throws Exception\BillApiException
	 */
	protected static function billResponseValidate(array $response): void
	{
		if (($response["success"] ?? false) === true) return;

		$code = (int)($response["code"] ?? -1);
		$message = $response["message"] ?? "Unknown error";

		match ($code) {
			-422 => throw new Exception\RequiredParamException(message: $message, code: $code),
			-401 => throw new Exception\UnauthorizedException(message: $message, code: $code),
			-34 => throw new Exception\VoucherCardExpiredException(message: $message, code: $code),
			-33 => throw new Exception\VoucherCardUsedException(message: $message, code: $code),
			-32 => throw new Exception\VoucherCardBlockedException(message: $message, code: $code),
			-30 => throw new Exception\VoucherCardFormatException(message: $message, code: $code),
			-29 => throw new Exception\VoucherCardLengthException(message: $message, code: $code),
			-28 => throw new Exception\ActivationErrorException(message: $message, code: $code),
			-27 => throw new Exception\AlreadyDeactivatedException(message: $message, code: $code),
			-24 => throw new Exception\NoMoneyException(message: $message, code: $code),
			-23 => throw new Exception\WrongPasswordException(message: $message, code: $code),
			-22 => throw new Exception\AlreadyActivatedException(message: $message, code: $code),
			-15 => throw new Exception\SmsSendException(message: $message, code: $code),
			-14 => throw new Exception\OverLimitException(message: $message, code: $code),
			-11 => throw new Exception\WrongValueException(message: $message, code: $code),
			-10 => throw new Exception\NotEnabled(message: $message, code: $code),
			default => throw new Exception\BillApiException(message: $message, code: $code),
		};
	}

	protected static function generateSalt(): string
	{
		try {
			return bin2hex(random_bytes(16));
		} catch (Throwable) {
			return uniqid("", true);
		}
	}
}
