<?php

declare(strict_types=1);

namespace Tests\Haikiri\MikBiLL;

use Haikiri\MikBiLL\Exception\BillApiException;
use PHPUnit\Framework\TestCase;
use Tests\Haikiri\MikBiLL\Mock\CreateApi;
use Tests\Haikiri\MikBiLL\Mock\MikBiLLApiMock;

final class UserTest extends TestCase
{
	use CreateApi;

	protected static string $signKey = "not-expected";
	protected static ?string $token = "Bearer eyJ0eXAiOi.JKV1QiLCJ.hbGciOiJIUzI.1NiJ9";
	private static string $dataFile = __DIR__ . "/Responses/valid/Cabinet/user/user.get.json";

	/**
	 * @return void
	 * @throws BillApiException
	 * @noinspection SpellCheckingInspection
	 */
	public function testMainUserPayloadFieldsAreMappedCorrectly(): void
	{
		# Инициализация SDK.
		$MikBiLL = self::fromFile(self::$dataFile);

		# Выполняем запрос в биллинг.
		$user = $MikBiLL->cabinet->User()->getUser();
		self::assertNotEmpty($user);

		# Сверяем объект с ожидаемыми значениями.
		$cases = [
			"getUserSector" => ["1. Основной", fn() => $user->getUserSector()],
			"getUserAddress" => ["Мадрид, Тележкина 30/12", fn() => $user->getUserAddress()],
			"getUserCurrency" => ["руб", fn() => $user->getUserCurrency()],
			"getUserTariffName" => ["оптика_5Mb", fn() => $user->getUserTariffName()],
			"getUserTariffSpeedIn" => [5, fn() => $user->getUserTariffSpeedIn()],
			"getUserTariffSpeedOut" => [5, fn() => $user->getUserTariffSpeedOut()],
			"getUserTariffFixedCost" => [400.0, fn() => $user->getUserTariffFixedCost()],
			"getFixedCostOnPerDay" => [10.0, fn() => $user->getFixedCostOnPerDay()],
			"getUserCharge" => [4030.0, fn() => $user->getUserCharge()],
			"getPacket" => ["оптика_5Mb", fn() => $user->getPacket()],
			"getPacketName" => ["оптика_5Mb", fn() => $user->getPacketName()],
			"getUserTurboTime" => [24, fn() => $user->getUserTurboTime()],
			"isUserTurboActivated" => [false, fn() => $user->isUserTurboActivated()],
			"isUserTurboDo" => [true, fn() => $user->isUserTurboDo()],
			"getUserCreditCost" => [15.0, fn() => $user->getUserCreditCost()],
			"getUserPaymentMethodsCount" => [true, fn() => count($user->getUserPaymentMethods()) > 3],
			"getUserShowCount" => [true, fn() => count($user->getUserShow()) > 3],
			"getUserFeeCount" => [true, fn() => count($user->getUserFee()) > 3],
			"getDaysLeft" => [110, fn() => $user->getDaysLeft()],
		];

		foreach ($cases as $label => [$expected, $resolver]) {
			self::assertSame($expected, $resolver(), $label);
		}
	}

	/**
	 * Примеры работы со временем.
	 * @return void
	 * @throws BillApiException
	 */
	public function testDateFormatting(): void
	{
		$MikBiLL = self::fromFile(self::$dataFile);
		$user = $MikBiLL->cabinet->User()->getUser();

		# Пример получения даты.
		self::assertSame("16-05-2022", $user->getDateItog());

		# Пример преобразования даты.
		$endDate = $user->getEndDate();
		self::assertSame("16.05.2022", $endDate->format("d.m.Y"));
		self::assertSame("16-05-2022", $endDate->format("d-m-Y"));
		self::assertSame("Оплачено до: 16.05.2022", "Оплачено до: " . $endDate->format("d.m.Y"));
	}

	/**
	 * Проверяем валидность даты после активации кредита.
	 * @return void
	 * @throws BillApiException
	 * @noinspection SpellCheckingInspection
	 */
	public function testCreditActivationDate(): void
	{
		# Имитируем получение ответа от API.
		$json = json_encode([
			"success" => true,
			"data" => [
				"do_credit_vremen_start_date" => "2025/12/31 10:11:12",
			]
		]);

		# Инициализируем Биллинг.
		$MikBiLL = new MikBiLLApiMock(
			url: "http://api.mikbill.local",
			key: self::$signKey,
			mockedData: $json,
		);

		# Записываем токен.
		$MikBiLL->setUserToken(self::$token);

		##################################################

		# Выполняем запрос в биллинг.
		$user = $MikBiLL->cabinet->User()->getUser();
		$date = $user->getCreditActivationDate();

		# Пример манипуляции со временем.
		self::assertSame("31.12.2025", $date?->format("d.m.Y"));
		self::assertSame("31-12-2025", $date?->format("d-m-Y"));
		self::assertSame("Кредит был активирован: 31.12.2025", "Кредит был активирован: " . $date?->format("d.m.Y"));
	}

}
