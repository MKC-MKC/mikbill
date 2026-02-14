<?php

declare(strict_types=1);

namespace Tests\Haikiri\MikBiLL\Main;

use Haikiri\MikBiLL\MikBiLLApiAbstract;
use LogicException;
use PHPUnit\Framework\TestCase;

final class MikBiLLApiAbstractTest extends TestCase
{
	protected static ?string $token = "Bearer eyJ0eXAiOi.JKV1QiLCJ.hbGciOiJIUzI.1NiJ9";

	/**
	 * Создаём абстрактный слой MikBiLL класса.
	 * @return MikBiLLApiAbstract
	 */
	private function createApi(): MikBiLLApiAbstract
	{
		return new class("https://api.example.com", "secret-key") extends MikBiLLApiAbstract {
			public function sendRequest($uri, $method = "POST", $params = [], $sign = false, $token = null)
			{
				throw new LogicException("Not used in this test.");
			}
		};
	}

	/**
	 * Проверяем корректность работы с токеном.
	 */
	public function testUserTokenCanBeSetAndReadThroughAliases()
	{
		# Создаём тестовый экземпляр API.
		$MikBiLL = $this->createApi();

		# Проверяем сохранение валидного Bearer-токена без изменений.
		$MikBiLL->setUserToken(self::$token);
		self::assertSame(self::$token, $MikBiLL->getUserToken());

		# Проверяем очистку токена при null.
		$MikBiLL->setUserToken(null);
		self::assertSame("", $MikBiLL->getUserToken());
	}

	/**
	 * Тест валидатора.
	 */
	public function testValidateResponse()
	{
		# Имитируем получение ответа от API.
		$json = json_encode([
			"success" => true,
			"data" => [
				"token" => "Bearer token",
			]
		]);

		# Валидируем корректный JSON-объект ответа API.
		$result = MikBiLLApiAbstract::validate($json, true);

		# Убеждаемся что валидатор возвращает массив.
		self::assertIsArray($result);
		self::assertTrue($result["success"]);

		# Ожидаем исключение, если JSON валиден синтаксически, но оне не является объектом/массивом.
		$this->expectException(LogicException::class);
		$this->expectExceptionMessage("must be object or array");
		MikBiLLApiAbstract::validate("1", true);
	}

	/**
	 * Проверяем, что JSON повреждён и бросает палку корректно.
	 */
	public function testValidateThrowsForInvalidJson()
	{
		$this->expectException(LogicException::class);
		MikBiLLApiAbstract::validate('{"success":', true);
	}
}
