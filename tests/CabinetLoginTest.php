<?php

declare(strict_types=1);

namespace Haikiri\MikBiLL\Tests;

use Haikiri\MikBiLL\Tests\Mock\MikBiLLApiMock as MikBiLLApi;
use Haikiri\MikBiLL\Tests\Trait\InitTrait;
use PHPUnit\Framework\TestCase;

class CabinetLoginTest extends TestCase
{
	use InitTrait;

	private static MikBiLLApi $MikBiLL;
	private static bool $debug = false;
	private static string $signKey = "not-expected";
	private static ?string $token = "Bearer eyJ0eXAiOi.JKV1QiLCJ.hbGciOiJIUzI.1NiJ9";
	private static string $dataFile = __DIR__ . "/Responses/valid/Cabinet/auth/login.post.json";

	public function test_Cabinet_Auth_login_getToken(): void
	{
		$expected = self::$token;
		$response = self::$MikBiLL->cabinet->Auth()->login("user", "pass");
		$data = $response->getToken();

		$this->assertEquals(expected: $expected, actual: $data);
	}

}
