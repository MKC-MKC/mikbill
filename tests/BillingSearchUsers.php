<?php

declare(strict_types=1);

namespace Haikiri\MikBiLL\Tests;

use Haikiri\MikBiLL\Tests\Mock\MikBiLLApiMock as MikBiLLApi;
use Haikiri\MikBiLL\Tests\Trait\InitTrait;
use PHPUnit\Framework\TestCase;

/** @billing - Административный запрос требующий подпись. */
class BillingSearchUsers extends TestCase
{
	use InitTrait;

	private static MikBiLLApi $MikBiLL;
	private static bool $debug = false;
	private static string $signKey = "mockedSignKey";
	private static ?string $token = "not-expected";
	private static string $dataFile = __DIR__ . "/Responses/valid/Billing/Users/search.post.json";

	public function test_getUserId($expected = 1639): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")->getOne();
		$this->assertSame($expected, $data->getUserId());
	}

	public function test_getUserFIO($expected = "Иванько Петр Петрович"): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")->getOne();
		$this->assertSame($expected, $data->getUserFIO());
	}

	public function test_getUserFirstName($expected = "Петр"): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")->getOne();
		$this->assertSame($expected, $data->getUserFirstName());
	}

	public function test_getUserMiddleName($expected = "Петрович"): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")->getOne();
		$this->assertSame($expected, $data->getUserMiddleName());
	}

	public function test_getUserLastName($expected = "Иванько"): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")->getOne();
		$this->assertSame($expected, $data->getUserLastName());
	}

	public function test_getPacketName($expected = NULL): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")->getOne();
		$this->assertSame($expected, $data->getPacketName());
	}

}
