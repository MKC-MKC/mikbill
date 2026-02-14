<?php

declare(strict_types=1);

namespace Tests\Haikiri\MikBiLL;

use Haikiri\MikBiLL\Exception\BillApiException;
use PHPUnit\Framework\TestCase;
use Tests\Haikiri\MikBiLL\Mock\CreateApi;

final class ServicesTurboTest extends TestCase
{
	use CreateApi;

	protected static string $signKey = "not-expected";
	protected static ?string $token = "Bearer eyJ0eXAiOi.JKV1QiLCJ.hbGciOiJIUzI.1NiJ9";
	private static string $dataFile = __DIR__ . "/Responses/valid/Cabinet/services/turbo-after.get.json";

	/**
	 * Проверка перед активацией.
	 * @return void
	 * @throws BillApiException
	 */
	public function testTurboBeforeActivation(): void
	{
		# Инициализация SDK.
		$MikBiLL = self::fromFile(__DIR__ . "/Responses/valid/Cabinet/services/turbo-before.get.json");

		# Получаем объекты данных.
		$service = $MikBiLL->cabinet->Services()->getTurbo();

		# Сверяем объект с ожидаемыми значениями.
		$cases = [
			"isAvailable" => [true, $service->isAvailable()],
			"isActive" => [false, $service->isActive()],
			"getActivationCost" => [20.0, $service->getActivationCost()],
			"getSpeedInBites" => [102400, $service->getSpeedInBites()],
			"getSpeedOutBites" => [102400, $service->getSpeedOutBites()],
			"getTime" => [24, $service->getTime()],
			"getStopTime" => [null, $service->getStopTime()?->format("d.m.Y H:i:s")],
			"getSpeedIn" => [100, $service->getSpeedIn()],
			"getSpeedOut" => [100, $service->getSpeedOut()],
			"getCurrency" => ["грн", $service->getCurrency()],
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
	public function testTurboAfterActivation(): void
	{
		# Инициализация SDK.
		$MikBiLL = self::fromFile(__DIR__ . "/Responses/valid/Cabinet/services/turbo-after.get.json");

		# Получаем объекты данных.
		$service = $MikBiLL->cabinet->Services()->getTurbo();

		# Сверяем объект с ожидаемыми значениями.
		$cases = [
			"isAvailable" => [false, $service->isAvailable()],
			"isActive" => [true, $service->isActive()],
			"getActivationCost" => [20.0, $service->getActivationCost()],
			"getSpeedInBites" => [102400, $service->getSpeedInBites()],
			"getSpeedOutBites" => [102400, $service->getSpeedOutBites()],
			"getTime" => [24, $service->getTime()],
			"getStopTime" => ["25.05.2025 12:13:14", $service->getStopTime()?->format("d.m.Y H:i:s")],
			"getSpeedIn" => [100, $service->getSpeedIn()],
			"getSpeedOut" => [100, $service->getSpeedOut()],
			"getCurrency" => ["грн", $service->getCurrency()],
		];

		foreach ($cases as $label => [$expected, $actual]) {
			self::assertSame($expected, $actual, $label);
		}
	}

}
