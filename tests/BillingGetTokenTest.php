<?php

declare(strict_types=1);

namespace Haikiri\MikBiLL\Tests;

use Haikiri\MikBiLL\Tests\Mock\MikBiLLApiMock as MikBiLLApi;
use Haikiri\MikBiLL\Tests\Trait\InitTrait;
use PHPUnit\Framework\TestCase;

/** @billing - Административный запрос требующий подпись. */
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
		$uid = "Здесь должен быть токен клиента";

		# Выполняем запрос в Billing.
		$token = self::$MikBiLL->billing->Users()->getUserToken($uid);

		# Обязательно записываем токен в stateless хранилище SDK для последующих запросов.
		self::$MikBiLL->setUserToken(token: $token);

		# Получаем токен из хранилища.
		$data = self::$MikBiLL->getUserToken();

		# Убеждаемся в корректности полученных данных.
		$this->assertEquals(expected: self::$token, actual: $data);
	}

}
