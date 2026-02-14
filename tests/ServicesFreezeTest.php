<?php

declare(strict_types=1);

namespace Tests\Haikiri\MikBiLL;

use Haikiri\MikBiLL\Exception\BillApiException;
use PHPUnit\Framework\TestCase;
use Tests\Haikiri\MikBiLL\Mock\CreateApi;

final class ServicesFreezeTest extends TestCase
{
	use CreateApi;

	protected static string $signKey = "not-expected";
	protected static ?string $token = "Bearer eyJ0eXAiOi.JKV1QiLCJ.hbGciOiJIUzI.1NiJ9";

	/**
	 * Проверка перед активацией.
	 * @return void
	 * @throws BillApiException
	 */
	public function testFreezeBeforeActivation(): void
	{
		# Инициализация SDK.
		$MikBiLL = self::fromFile(__DIR__ . "/Responses/valid/Cabinet/services/freeze-before.get.json");

		# Получаем объекты данных.
		$service = $MikBiLL->cabinet->Services()->getFreeze();

		# Сверяем объект с ожидаемыми значениями.
		$cases = [
			"isAvailable" => [true, $service->isAvailable()],
			"isActive" => [false, $service->isActive()],
			"getActivationCost" => [0.0, $service->getActivationCost()],
			"getDeactivationCost" => [0.0, $service->getDeactivationCost()],
			"getCostDay" => [0.0, $service->getCostDay()],
			"getMinDay" => [1, $service->getMinDay()],
			"getFreeCount" => [0, $service->getFreeCount()],
			"getFreeCountUsed" => [1, $service->getFreeCountUsed()],
			"getDateStart" => ["22.02.2020", $service->getDateStart()->format("d.m.Y")],
			"getDateStop" => ["23.02.2020", $service->getDateStop()->format("d.m.Y")],
			"hasDateStopEver" => [false, $service->hasDateStopEver()],
			"getFreezeEver" => [true, $service->getFreezeEver()],
			"getReturnAp" => [false, $service->getReturnAp()],
			"isBalancePlus" => [false, $service->isBalancePlus()],
			"isFixedMonth" => [false, $service->isFixedMonth()],
			"canUnfreezeEarlierPay" => [false, $service->canUnfreezeEarlierPay()],
			"canUnfreezeEarlierDisallow" => [false, $service->canUnfreezeEarlierDisallow()],
			"getCurrency" => ["руб", $service->getCurrency()],
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
	public function testFreezeAfterActivation(): void
	{
		# Инициализация SDK.
		$MikBiLL = self::fromFile(__DIR__ . "/Responses/valid/Cabinet/services/freeze-after.get.json");

		# Получаем объекты данных.
		$service = $MikBiLL->cabinet->Services()->getFreeze();

		# Сверяем объект с ожидаемыми значениями.
		$cases = [
			"isAvailable" => [false, $service->isAvailable()],
			"isActive" => [true, $service->isActive()],
			"getActivationCost" => [0.0, $service->getActivationCost()],
			"getDeactivationCost" => [0.0, $service->getDeactivationCost()],
			"getCostDay" => [0.0, $service->getCostDay()],
			"getMinDay" => [1, $service->getMinDay()],
			"getFreeCount" => [0, $service->getFreeCount()],
			"getFreeCountUsed" => [1, $service->getFreeCountUsed()],
			"getDateStart" => ["22.02.2020", $service->getDateStart()->format("d.m.Y")],
			"getDateStop" => ["23.02.2020", $service->getDateStop()->format("d.m.Y")],
			"hasDateStopEver" => [true, $service->hasDateStopEver()],
			"getFreezeEver" => [true, $service->getFreezeEver()],
			"getReturnAp" => [false, $service->getReturnAp()],
			"isBalancePlus" => [false, $service->isBalancePlus()],
			"isFixedMonth" => [false, $service->isFixedMonth()],
			"canUnfreezeEarlierPay" => [false, $service->canUnfreezeEarlierPay()],
			"canUnfreezeEarlierDisallow" => [false, $service->canUnfreezeEarlierDisallow()],
			"getCurrency" => ["руб", $service->getCurrency()],
		];

		foreach ($cases as $label => [$expected, $actual]) {
			self::assertSame($expected, $actual, $label);
		}
	}

}
