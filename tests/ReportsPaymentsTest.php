<?php

declare(strict_types=1);

namespace Tests\Haikiri\MikBiLL;

use DateTime;
use Haikiri\MikBiLL\Exception\BillApiException;
use PHPUnit\Framework\TestCase;
use Tests\Haikiri\MikBiLL\Mock\CreateApi;

final class ReportsPaymentsTest extends TestCase
{
	use CreateApi;

	protected static string $signKey = "not-expected";
	protected static ?string $token = "Bearer eyJ0eXAiOi.JKV1QiLCJ.hbGciOiJIUzI.1NiJ9";
	private static string $dataFile = __DIR__ . "/Responses/valid/Cabinet/reports/payments.json";

	/**
	 * @throws BillApiException
	 */
	public function testGetPaymentsReturnsCollectionWithExpectedFirstItem(): void
	{
		# Инициализация SDK.
		$MikBiLL = self::fromFile(self::$dataFile);

		# Получаем объекты данных.
		$payments = $MikBiLL->cabinet->Reports()->getPayments(
			limit: 5,
			offset: 0,
			order: "desc",
			from: new DateTime(),
			to: (new DateTime())->modify("+3 days"),
		);
		self::assertGreaterThan(1, count($payments));

		# Сверяем первый объект с ожидаемыми значениями.
		$first = $payments[0];
		$cases = [
			"getId" => [34, $first->getId()],
			"getName" => ['Услуга "Турбо"', $first->getName()],
			"getSumma" => [20, $first->getSumma()],
			"getSign" => ["?", $first->getSign()],
			"getComment" => ["", $first->getComment()],
			"getDate" => ["25.05.2025 в 14:00:54", $first->getDate()?->format("d.m.Y в H:i:s")],
		];

		foreach ($cases as $label => [$expected, $actual]) {
			self::assertSame($expected, $actual, $label);
		}
	}

}
