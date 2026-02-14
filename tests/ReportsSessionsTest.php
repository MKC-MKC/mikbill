<?php

declare(strict_types=1);

namespace Tests\Haikiri\MikBiLL;

use DateTime;
use Haikiri\MikBiLL\Exception\BillApiException;
use PHPUnit\Framework\TestCase;
use Tests\Haikiri\MikBiLL\Mock\CreateApi;

final class ReportsSessionsTest extends TestCase
{
	use CreateApi;

	protected static string $signKey = "not-expected";
	protected static ?string $token = "Bearer eyJ0eXAiOi.JKV1QiLCJ.hbGciOiJIUzI.1NiJ9";
	private static string $dataFile = __DIR__ . "/Responses/valid/Cabinet/reports/sessions.json";

	/**
	 * @throws BillApiException
	 */
	public function testGetSessionsReturnsCollectionWithExpectedFirstItem(): void
	{
		# Инициализация SDK.
		$MikBiLL = self::fromFile(self::$dataFile);

		# Получаем объекты данных.
		$sessions = $MikBiLL->cabinet->Reports()->getSessions(
			limit: 2,
			offset: 0,
			order: "ASC",
			from: new DateTime(),
			to: (new DateTime())->modify("+3 days"),
		);
		self::assertGreaterThan(1, count($sessions));

		# Сверяем первый объект с ожидаемыми значениями.
		$first = $sessions[0];
		$cases = [
			"getUsername" => ["username", $first->getUsername()],
			"getBillingBefore" => [332.718616, $first->getBillingBefore()],
			"getBillingMinus" => [0.0, $first->getBillingMinus()],
			"getTimeOn" => [1300127, $first->getTimeOn()],
			"getStartDateTime" => ["04.12.2024 в 11:17:47", $first->getStartDateTime()?->format("d.m.Y в H:i:s")],
			"getStopDateTime" => ["19.12.2024 в 12:26:34", $first->getStopDateTime()?->format("d.m.Y в H:i:s")],
			"getCallFrom" => ["", $first->getCallFrom()],
			"getIpAddress" => ["10.100.111.254", $first->getIpAddress()],
			"getFramedIpAddress" => ["10.100.111.254", $first->getFramedIpAddress()],
			"getIn" => [28120.4, $first->getIn()],
			"getOut" => [3860.2, $first->getOut()],
		];

		foreach ($cases as $label => [$expected, $actual]) {
			self::assertSame($expected, $actual, $label);
		}
	}

}
