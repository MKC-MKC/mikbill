<?php

declare(strict_types=1);

namespace Tests\Haikiri\MikBiLL\Main;

use Haikiri\MikBiLL\Exception\UnauthorizedException;
use PHPUnit\Framework\TestCase;
use Tests\Haikiri\MikBiLL\Mock\MikBiLLApiMock;

final class MikBiLLApiMockTest extends TestCase
{

	/**
	 * Имитируем валидный JSON-ответ.
	 */
	private static function successResponse(): string
	{
		return '{"success":true,"code":0,"message":"OK","data":{"token":"Bearer test"}}';
	}

	/**
	 * Тест на отсутствие смешения данных с двумя разными инстансами.
	 * @noinspection PhpUnhandledExceptionInspection
	 */
	public function testInstancesDoNotShareSigningState(): void
	{
		# Создаём два независимых MikBiLL Mock: один с корректным ключом, второй с некорректным.
		$validApi = new MikBiLLApiMock("http://api.mikbill.local", "mockedSignKey", self::successResponse());
		$invalidApi = new MikBiLLApiMock("http://api.mikbill.local", "wrongSignKey", self::successResponse());

		# Убеждаемся, что неверный ключ действительно даёт UnauthorizedException.
		try {
			$invalidApi->sendRequest("/api/v1/billing/users/token", "POST", ["uid" => 1], true);
			self::fail("Expected UnauthorizedException for invalid signing key.");
		} catch (UnauthorizedException) {
			# Можно обработать ошибку если ключ неверный.
		}

		# Убеждаемся, что корректный инстанс после этого всё ещё работает успешно.
		$validResponse = $validApi->sendRequest("/api/v1/billing/users/token", "POST", ["uid" => 1], true);
		self::assertTrue($validResponse->isSuccess());
	}

}
