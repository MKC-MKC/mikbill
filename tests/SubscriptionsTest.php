<?php

declare(strict_types=1);

namespace Tests\Haikiri\MikBiLL;

use PHPUnit\Framework\TestCase;
use Tests\Haikiri\MikBiLL\Mock\MikBiLLApiMock as MikBiLLApi;

/**
 * Тестирование системы подписок.
 * @cabinet - Клиентские запросы требуют токен клиента.
 */
class SubscriptionsTest extends TestCase
{
	private static MikBiLLApi $MikBiLL;
	private static bool $debug = false;
	private static string $signKey = "not-expected";
	private static ?string $token = "Bearer eyJ0eXAiOi.JKV1QiLCJ.hbGciOiJIUzI.1NiJ9";

	public static function processData($path): void
	{
		# Подготовка тестовых данных.
		$json = file_get_contents($path);

		# Инициализация MikBiLL SDK.
		self::$MikBiLL = new MikBiLLApi(
			url: "http://api.mikbill.local",
			key: self::$signKey,
			mockedData: $json,
		);

		# Записываем токен пользователя.
		self::$MikBiLL->setUserToken(self::$token);
	}

	/**
	 * Просмотр всех доступных подписок клиента на данный момент.
	 */
	public function test_1($expected = 4)
	{
		# Имитируем получение ответа от API.
		self::processData(path: __DIR__ . "/Responses/valid/Cabinet/subscriptions/other.get.json");

		# Выполняем запрос в биллинг.
		$middleware = "other";
		$response = self::$MikBiLL->cabinet->Subscriptions()->getSubscriptions(service: $middleware);

		# Можете посмотреть на массив, если включен debug.
		if (self::$debug) {
			echo "<h3>Доступные подписки клиенту:</h3>";
			foreach ($response as $sub) {
				echo "<hr><h2><code>[id:{$sub->getId()}] " . $sub->getName() . "</code></h2>";
				echo "<li>Цена: {$sub->getServicePrice()} {$sub->getCurrency()}.</li>";
				echo "<p>Описание: {$sub->getDescription()}</p>";
			}
		}

		# Проверяем для теста количество массивов в ответе.
		$data = count($response);
		$this->assertSame($expected, $data, "Получено получено: `$data/$expected`.");
	}

	/**
	 * Пример как подписаться на услугу не связанную с Middleware.
	 */
	public function test_2($expected = true)
	{
		# Имитируем получение ответа от API.
		self::processData(path: __DIR__ . "/Responses/valid/Cabinet/subscriptions/other.post.json");

		# Выполняем запрос в биллинг.
		$id = "100";
		$middleware = "other";
		$status = self::$MikBiLL->cabinet->Subscriptions()->setSubscription(id: $id, activate: 1, service: $middleware);

		# Проверяем, является ли ответ на подписку положительным.
		$this->assertSame($expected, $status);
	}

	/**
	 * Пример как получить список доступных клиенту - middleware.
	 */
	public function test_3($expected = 6)
	{
		# Имитируем получение ответа от API.
		self::processData(path: __DIR__ . "/Responses/valid/Cabinet/subscriptions/middlewares.get.json");

		# Выполняем запрос в биллинг.
		$response = self::$MikBiLL->cabinet->Subscriptions()->getMiddlewares();

		# Получаем массив объектов.
		$mws = $response->getMiddlewares();

		# Можете посмотреть на массив, если включен debug.
		if (self::$debug) {
			foreach ($mws as $middleware) {
				# Пример использования массива и объектов
				echo "<hr><h2><code>[id:{$middleware->getId()}] " . $middleware->getData("name") . "</code></h2>";
			}
		}

		# Проверяем для теста количество массивов в ответе.
		$data = count($mws);
		$this->assertSame($expected, $data, "Получено получено: `$data/$expected`.");
	}

}
