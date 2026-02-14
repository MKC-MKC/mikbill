<?php

namespace Tests\Haikiri\MikBiLL\Mock;

use Haikiri\MikBiLL\Exception;
use Haikiri\MikBiLL\MikBiLLApi;
use Haikiri\MikBiLL\Response;

class MikBiLLApiMock extends MikBiLLApi
{
	private static ?string $mockedData;
	private static ?string $received_key = null;
	private static string $expected_key = "mockedSignKey";
	private static string $expected_token = "Bearer eyJ0eXAiOi.JKV1QiLCJ.hbGciOiJIUzI.1NiJ9";

	public function __construct(string $url, string $key, mixed $mockedData = null)
	{
		parent::__construct($url, $key);
		self::$mockedData = $mockedData;
		self::$received_key = $key;
	}

	public function sendRequest($uri, $method = "POST", $params = [], $sign = false, $token = null): Response
	{
		# По умолчанию готовим переданный ответ.
		$response = self::$mockedData;

		# Подпись запроса.
		if ($sign) {
			# Генерация ключа HMAC.
			$salt = self::generateSalt();
			$sign = hash_hmac("sha512", $salt, self::$received_key);

			if (self::$debug) {
				error_log("SALT: " . $salt);
				error_log("SIGN: " . $sign);
			}

			# Имитируем проверку ключа на стороне Api.
			$expectedSign = hash_hmac("sha512", $salt, self::$expected_key);
			if (!hash_equals($expectedSign, $sign)) $response = self::onUnauthorized();
		} else {
			if (self::$debug) {
				error_log("Received Token: " . $token);
				error_log("Expected Token: " . self::$expected_token);
			}
			if ($token === "") throw new Exception\UnauthorizedException("The token was not found: The storage with token is empty.", -999);
			if (!is_null($token) && $token !== self::$expected_token) $response = self::onUnauthorized();
		}

		# Проверяем и возвращаем данные.
		$validResponse = self::validate($response, true);
		self::billResponseValidate($validResponse);
		return Response::fromResponse($validResponse);
	}

	private static function onUnauthorized(): string
	{
		return file_get_contents(__DIR__ . "/../Responses/invalid/401-unauthorized.json");
	}

}
