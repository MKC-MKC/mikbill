<?php

declare(strict_types=1);

namespace Tests\Haikiri\MikBiLL;

use PHPUnit\Framework\TestCase;
use Tests\Haikiri\MikBiLL\Mock\CreateApi;

final class CommonTest extends TestCase
{
	use CreateApi;

	protected static string $signKey = "not-expected";
	protected static ?string $token = "Bearer eyJ0eXAiOi.JKV1QiLCJ.hbGciOiJIUzI.1NiJ9";

	public function testGetIpReturnsAddress(): void
	{
		$MikBiLL = self::fromFile(__DIR__ . "/Responses/valid/Cabinet/getip.get.json");
		$result = $MikBiLL->cabinet->Common()->getIp()->getIp();
		self::assertSame("10.11.12.13", $result);
	}

	public function testGetDateReturnsServerDateTime(): void
	{
		$MikBiLL = self::fromFile(__DIR__ . "/Responses/valid/Cabinet/serverdate.get.json");
		$result = $MikBiLL->cabinet->Common()->getDate()->getDateTime();
		self::assertSame("22.05.2025 15:00:00", $result?->format("d.m.Y H:i:s"));
	}
}
