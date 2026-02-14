<?php

declare(strict_types=1);

namespace Tests\Haikiri\MikBiLL;

use Haikiri\MikBiLL\Exception\BillApiException;
use PHPUnit\Framework\TestCase;
use Tests\Haikiri\MikBiLL\Mock\CreateApi;

/**
 * Тестирование получения токена по UID клиента.
 * @billing - Административные запросы требуют подпись.
 */
class BillingGetTokenTest extends TestCase
{
	use CreateApi;

	protected static string $signKey = "mockedSignKey";
	protected static ?string $token = "Bearer eyJ0eXAiOi.JKV1QiLCJ.hbGciOiJIUzI.1NiJ9";
	private static string $dataFile = __DIR__ . "/Responses/valid/Billing/Users/token.post.json";

	/**
	 * Получение токена.
	 * @throws BillApiException
	 */
	public function test()
	{
		# Инициализация SDK.
		$MikBiLL = self::fromFile(self::$dataFile);

		# Валидация данных.
		$uid = "Здесь должен быть UID клиента";

		# Выполняем запрос в Billing.
		$token = $MikBiLL->billing->Users()->getUserToken($uid);

		# Обязательно записываем токен в stateless хранилище SDK для последующих запросов.
		$MikBiLL->setUserToken(token: $token);

		# Получаем токен из хранилища.
		$data = $MikBiLL->getUserToken();

		# Убеждаемся в корректности полученных данных.
		self::assertSame(expected: self::$token, actual: $data);
	}
}
