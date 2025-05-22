<?php

namespace Haikiri\MikBiLL\Tests;

use Haikiri\MikBiLL\Tests\Mock\MikBiLLApiMock as MikBiLLApi;
use Haikiri\MikBiLL\Tests\Trait\InitTrait;
use PHPUnit\Framework\TestCase;

class CabinetUserTest extends TestCase
{
	use InitTrait;

	private static MikBiLLApi $MikBiLL;
	private static bool $debug = false;
	private static string $signKey = "not-expected";
	private static ?string $token = "Bearer eyJ0eXAiOi.JKV1QiLCJ.hbGciOiJIUzI.1NiJ9";
	private static string $dataFile = __DIR__ . "/Responses/valid/Cabinet/user/user.get.json";

	public function test_getUserId($expected = 1639): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserId());
	}

	public function test_getUserFIO($expected = "Иванько Петр Петрович"): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserFIO());
	}

	public function test_getUserFirstName($expected = "Петр"): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserFirstName());
	}

	public function test_getUserMiddleName($expected = "Петрович"): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserMiddleName());
	}

	public function test_getUserLastName($expected = "Иванько"): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserLastName());
	}

	public function test_getPacketName($expected = "оптика_5Mb"): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getPacketName());
	}

}
