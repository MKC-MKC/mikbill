<?php

declare(strict_types=1);

namespace Tests\Haikiri\MikBiLL;

use Tests\Haikiri\MikBiLL\Mock\MikBiLLApiMock as MikBiLLApi;
use Tests\Haikiri\MikBiLL\Trait\InitTrait;
use PHPUnit\Framework\TestCase;

/**
 * Тестирование получения токена по UID клиента.
 * @billing - Административные запросы требуют подпись.
 */
class BillingGetTokenTest extends TestCase
{
	use InitTrait;

	private static MikBiLLApi $MikBiLL;
	private static bool $debug = false;
	private static string $signKey = "mockedSignKey";
	private static ?string $token = "Bearer eyJ0eXAiOi.JKV1QiLCJ.hbGciOiJIUzI.1NiJ9";
	private static string $dataFile = __DIR__ . "/Responses/valid/Billing/Users/token.post.json";

	/**
	 * Получение токена.
	 */
	public function test()
	{
		# Валидация данных.
		$uid = "Здесь должен быть UID клиента";

		# Выполняем запрос в Billing.
		$token = self::$MikBiLL->billing->Users()->getUserToken($uid);

		# Обязательно записываем токен в stateless хранилище SDK для последующих запросов.
		self::$MikBiLL->setUserToken(token: $token);

		# Получаем токен из хранилища.
		$data = self::$MikBiLL->getUserToken();

		# Убеждаемся в корректности полученных данных.
		$this->assertSame(expected: self::$token, actual: $data);
	}
}
