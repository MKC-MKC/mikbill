<?php

declare(strict_types=1);

namespace Tests\Haikiri\MikBiLL\Main;

use Haikiri\MikBiLL\ResponseWrapper;
use PHPUnit\Framework\TestCase;

final class ResponseWrapperTest extends TestCase
{
	/**
	 * Убеждаемся, что `getAsArray` возвращает массив без изменений.
	 */
	public function testGetAsArrayReturnsOriginalData()
	{
		# Создаём тестовую обёртку.
		$payload = ["user" => ["id" => 42, "name" => "Ivan"]];
		$wrapper = new class($payload) extends ResponseWrapper {
			# Без данных.
		};

		# Проверяем, что получаем исходную структуру.
		self::assertSame($payload, $wrapper->getAsArray());
	}

	/**
	 * Проверяем метод `getData`, что работает `dot-notation` для вложенных массивов.
	 */
	public function testGetDataSupportsDotNotation()
	{
		# Создаём тестовую обёртку.
		$wrapper = new class(["user" => ["profile" => ["email" => "user@example.com"]]]) extends ResponseWrapper {
			# Без данных.
		};

		# Проверяем извлечение вложенного поля по пути user.profile.email.
		self::assertSame("user@example.com", $wrapper->getData("user.profile.email"));

		# Проверяем работоспособность fallback-значения при отсутствии вместо ошибки/исключения.
		self::assertSame("fallback", $wrapper->getData("user.profile.name", "fallback"));
	}

	/**
	 * Проверяем метод `getData`, что вернёт весь массив при пустом ключе.
	 */
	public function testGetDataSupportsDotNotationWhenKeyIsNull()
	{
		# Создаём тестовую обёртку.
		$payload = ["items" => [1, 2, 3]];
		$wrapper = new class($payload) extends ResponseWrapper {
			# Без данных.
		};

		# Проверяем возврат всего массива данных.
		self::assertSame($payload, $wrapper->getData());
	}

	/**
	 * Убеждаемся, что метод `getData` возвращает fallback default данные при отсутствии данных в ответе.
	 */
	public function testGetDataWorksWithNullPayload()
	{
		# Создаём обёртку без данных.
		$wrapper = new class(null) extends ResponseWrapper {
			# Без данных.
		};

		# Проверяем возврат null для сырых данных и default для отсутствующего пути.
		self::assertNull($wrapper->getData());
		self::assertNull($wrapper->getAsArray());
		self::assertSame("default-value", $wrapper->getData("user.id", "default-value"));
	}

}
