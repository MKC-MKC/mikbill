<?php

declare(strict_types=1);

namespace Haikiri\MikBiLL\Tests;

use Haikiri\MikBiLL\Tests\Mock\MikBiLLApiMock as MikBiLLApi;
use Haikiri\DeclensionHelper\Declension;
use PHPUnit\Framework\TestCase;

/**
 * Тестирование системы услуг.
 * @cabinet - Клиентский запрос требующий токен клиента.
 */
class UserServicesTest extends TestCase
{
	private static MikBiLLApi $MikBiLL;
	private static string $signKey = "not-expected";
	private static ?string $token = "Bearer eyJ0eXAiOi.JKV1QiLCJ.hbGciOiJIUzI.1NiJ9";

	public static function processData($path): void
	{
		# Подготовка тестовых данных.
		$json = file_get_contents($path);

		# Инициализация MikBiLL SDK.
		self::$MikBiLL = new Mock\MikBiLLApiMock(
			url: "http://api.mikbill.local",
			key: self::$signKey,
			mockedData: $json,
		);

		# Записываем токен пользователя.
		self::$MikBiLL->setUserToken(self::$token);
	}

	/**
	 * Проверяем стоимость активации услуги "Кредит".
	 */
	public function test_1($expected = "Стоимость активации 15 рублей!"): void
	{
		self::processData(path: __DIR__ . "/Responses/valid/Cabinet/services/credit-before.get.json");
		$response = self::$MikBiLL->cabinet->Services()->getCredit();

		$cost = $response->getActivateCost(); # "15.00"
		$currency = $response->getCurrency(); # "руб."
		$template = "Стоимость активации {item} {form}!"; # маска

		Declension::set($currency, ["рубль", "рубля", "рублей"]);
		$data = Declension::format(number: $cost, key: $currency, template: $template);

		$this->assertEquals(expected: $expected, actual: $data);
	}

	/**
	 * Проверяем дату начала кредита.
	 */
	public function test_2($expected = "21.05.2025"): void
	{
		self::processData(path: __DIR__ . "/Responses/valid/Cabinet/services/credit-before.get.json");
		$data = self::$MikBiLL->cabinet->Services()->getCredit();
		$this->assertEquals(expected: $expected, actual: $data->getDateStart()->format("d.m.Y"));
	}

	/**
	 * Проверяем дату окончания кредита.
	 */
	public function test_3($expected = "24.05.2025"): void
	{
		self::processData(path: __DIR__ . "/Responses/valid/Cabinet/services/credit-after.get.json");
		$data = self::$MikBiLL->cabinet->Services()->getCredit();
		$this->assertEquals(expected: $expected, actual: $data->getDateStop()->format("d.m.Y"));
	}

	/**
	 * Проверяем стоимость активации услуги "Турбо".
	 */
	public function test_4($expected = "Вартість активації послуги: 20 гривень"): void
	{
		self::processData(path: __DIR__ . "/Responses/valid/Cabinet/services/turbo-before.get.json");
		$response = self::$MikBiLL->cabinet->Services()->getTurbo();

		$cost = $response->getActivationCost(); # "20.00"
		$currency = $response->getCurrency(); # "грн."
		$template = "Вартість активації послуги: {item} {form}"; # маска

		Declension::set($currency, ["гривня", "гривні", "гривень"]);
		$data = Declension::format(number: $cost, key: $currency, template: $template);

		$this->assertEquals(expected: $expected, actual: $data);
	}

	/**
	 * Проверяем возможность активации услуги "Заморозка".
	 */
	public function test_5(): void
	{
		self::processData(path: __DIR__ . "/Responses/valid/Cabinet/services/freeze-before.get.json");
		$response = self::$MikBiLL->cabinet->Services()->getFreeze();
		$data = $response->isAvailable();
		$this->assertEquals(expected: true, actual: $data);
	}

}
