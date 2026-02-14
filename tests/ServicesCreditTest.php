<?php

declare(strict_types=1);

namespace Tests\Haikiri\MikBiLL;

use Haikiri\MikBiLL\Exception\BillApiException;
use PHPUnit\Framework\TestCase;
use Tests\Haikiri\MikBiLL\Mock\CreateApi;

final class ServicesCreditTest extends TestCase
{
	use CreateApi;

	protected static string $signKey = "not-expected";
	protected static ?string $token = "Bearer eyJ0eXAiOi.JKV1QiLCJ.hbGciOiJIUzI.1NiJ9";

	/**
	 * Проверка перед активацией.
	 * @return void
	 * @throws BillApiException
	 */
	public function testCreditBeforeActivation(): void
	{
		# Инициализация SDK.
		$MikBiLL = self::fromFile(__DIR__ . "/Responses/valid/Cabinet/services/credit-before.get.json");

		# Получаем объекты данных.
		$service = $MikBiLL->cabinet->Services()->getCredit();

		# Сверяем объект с ожидаемыми значениями.
		$cases = [
			"isAvailable" => [false, $service->isAvailable()],
			"isActive" => [true, $service->isActive()],
			"getActivationCost" => [15.0, $service->getActivationCost()],
			"getCreditPercent" => [0, $service->getCreditPercent()],
			"getType" => [-1, $service->getType()],
			"getCurrency" => ["руб", $service->getCurrency()],
			"getCreditSum" => [416.0, $service->getCreditSum()],
			"canEarlyLoanRepayment" => [true, $service->canEarlyLoanRepayment()],
			"getAvailableDays" => [10, $service->getAvailableDays()],
			"getCreditDayStart" => [21, $service->getCreditDayStart()],
			"getCreditDayStop" => [24, $service->getCreditDayStop()],
			"getDateStart" => ["21.05.2025", $service->getDateStart()->format("d.m.Y")],
			"getDateStop" => ["24.05.2025", $service->getDateStop()->format("d.m.Y")],
			"getActivationDays" => [3, $service->getActivationDays()],
		];

		foreach ($cases as $label => [$expected, $actual]) {
			self::assertSame($expected, $actual, $label);
		}
	}

	/**
	 * Проверка после активации.
	 * @return void
	 * @throws BillApiException
	 */
	public function testCreditAfterActivation(): void
	{
		# Инициализация SDK.
		$MikBiLL = self::fromFile(__DIR__ . "/Responses/valid/Cabinet/services/credit-after.get.json");

		# Получаем объекты данных.
		$service = $MikBiLL->cabinet->Services()->getCredit();

		# Сверяем объект с ожидаемыми значениями.
		$cases = [
			"isAvailable" => [true, $service->isAvailable()],
			"isActive" => [false, $service->isActive()],
			"getActivationCost" => [15.0, $service->getActivationCost()],
			"getCreditPercent" => [0, $service->getCreditPercent()],
			"getType" => [3, $service->getType()],
			"getCurrency" => ["руб", $service->getCurrency()],
			"getCreditSum" => [416.0, $service->getCreditSum()],
			"canEarlyLoanRepayment" => [true, $service->canEarlyLoanRepayment()],
			"getAvailableDays" => [10, $service->getAvailableDays()],
			"getCreditDayStart" => [21, $service->getCreditDayStart()],
			"getCreditDayStop" => [24, $service->getCreditDayStop()],
			"getDateStart" => ["21.05.2025", $service->getDateStart()->format("d.m.Y")],
			"getDateStop" => ["24.05.2025", $service->getDateStop()->format("d.m.Y")],
			"getActivationDays" => [3, $service->getActivationDays()],
		];

		foreach ($cases as $label => [$expected, $actual]) {
			self::assertSame($expected, $actual, $label);
		}
	}

}
