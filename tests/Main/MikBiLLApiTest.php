<?php

declare(strict_types=1);

namespace Tests\Haikiri\MikBiLL\Main;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response as Psr7Response;
use Haikiri\MikBiLL\Exception\BillApiException;
use Haikiri\MikBiLL\Exception\UnauthorizedException;
use Haikiri\MikBiLL\MikBiLLApi;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

final class MikBiLLApiTest extends TestCase
{
	protected static string $signKey = "mockedSignKey";

	/**
	 * Тестируем формирование HTTP-запроса с очередями/историями.
	 * @param array $queue
	 * @param array $history
	 * @return MikBiLLApi
	 */
	private function createApi(array $queue, array &$history): MikBiLLApi
	{
		# Инициализируем контейнер истории, куда Guzzle сложит отправленные запросы.
		$history = [];

		# Поднимаем `Guzzle MockHandler` с заранее заданной очередью ответов.
		$mock = new MockHandler($queue);
		$stack = HandlerStack::create($mock);

		# Подключаем `guzzle middleware` истории, чтобы проверять собранный запрос после `sendRequest`.
		$stack->push(Middleware::history($history));

		# Создаём HTTP-клиент без отброса исключений. У нас есть свой валидатор.
		$mockedClient = new Client([
			"handler" => $stack,
			"http_errors" => false,
		]);

		# Создаём API-клиент.
		$MikBiLL = new MikBiLLApi("https://api.example.com", self::$signKey);

		# Подменяем Guzzle-клиент на тестовый `$mockedClient`.
		$reflection = new ReflectionClass($MikBiLL);
		$property = $reflection->getProperty("client");
		$property->setValue($MikBiLL, $mockedClient);

		return $MikBiLL;
	}

	/**
	 * Убеждаемся, что запросы в `cabinet api` не проходят без токена.
	 * @throws BillApiException
	 */
	public function testSendRequestThrowsWhenTokenStorageIsEmpty()
	{
		# Создаём API-клиент.
		$MikBiLL = new MikBiLLApi("https://api.example.com", self::$signKey);

		# Ожидаем UnauthorizedException, если токен пуст.
		$this->expectException(UnauthorizedException::class);
		$MikBiLL->cabinet->Common()->getIp();
	}

	/**
	 * Убеждаемся, что можем отправлять запрос на авторизацию в `cabinet api` без токена.
	 * @throws BillApiException
	 */
	public function testSendLoginRequestWithoutToken()
	{
		# Создаём API-клиент с одним успешным ответом в очереди и историей запросов.
		$history = [];
		$api = $this->createApi([
			new Psr7Response(200, [], '{"success":true,"code":0,"message":"OK","data":{"token":"Bearer x"}}'),
		], $history);

		# Выполняем запрос в Billing.
		$response = $api->cabinet->Auth()->login("username", "password");

		# Подтверждаем успех и отсутствие Authorization header.
		self::assertIsString($response->getToken());
		self::assertCount(1, $history);
		self::assertFalse($history[0]["request"]->hasHeader("Authorization"));
	}

	/**
	 * Убеждаемся что админ запрос в `billing api` использует валидную HMAC подпись.
	 * @throws BillApiException
	 */
	public function testSendAdminRequestWithSign()
	{
		# Создаём API-клиент.
		$history = [];
		$api = $this->createApi([
			new Psr7Response(200, [], '{"success":true,"code":0,"message":"OK","data":{"token":"Bearer x"}}'),
		], $history);

		# Имитируем запрос с флагом sign=true.
		$api->sendRequest("/api/v1/billing/users/token", "POST", ["uid" => "100"], true);

		# Извлекаем отправленный HTTP-запрос из истории.
		self::assertCount(1, $history);
		$request = $history[0]["request"];

		# Парсим тело запроса.
		parse_str((string)$request->getBody(), $payload);
		self::assertSame("100", $payload["uid"]);

		# Проверяем соления и подписи.
		self::assertNotEmpty($payload["salt"]);
		self::assertArrayHasKey("salt", $payload);
		self::assertNotEmpty($payload["sign"]);
		self::assertArrayHasKey("sign", $payload);

		# Ожидаем точное совпадение ключей.
		self::assertSame(hash_hmac("sha512", $payload["salt"], self::$signKey), $payload["sign"]);
	}

	/**
	 * Убеждаемся, что `BillApiException` отлавливает прочие ошибки из запроса.
	 * @noinspection SpellCheckingInspection
	 */
	public function testBillResponseValidateBillApiException()
	{
		$this->expectException(BillApiException::class);
		$this->expectExceptionCode(1202);
		$this->expectExceptionMessage("ERROR_SAVED_TO_GENERAL_LOGS");

		MikBiLLApi::billResponseValidate([
			"success" => false,
			"error" => 1202,
			"errortext" => "ERROR_SAVED_TO_GENERAL_LOGS",
			"data" => [],
		]);
	}

	/**
	 * Убеждаемся, что работает отлов ошибки при авторизации.
	 * @throws UnauthorizedException|BillApiException
	 */
	public function testBillResponseValidateUnauthorizedException()
	{
		$this->expectException(UnauthorizedException::class);
		$this->expectExceptionCode(-401);
		$this->expectExceptionMessage("Unauthorized");

		MikBiLLApi::billResponseValidate([
			"success" => false,
			"code" => -401,
			"message" => "Unauthorized",
		]);
	}

}
