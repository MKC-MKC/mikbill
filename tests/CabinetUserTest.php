<?php

namespace Haikiri\MikBiLL\Tests;

use Haikiri\MikBiLL\Tests\Mock\MikBiLLApiMock as MikBiLLApi;
use Haikiri\MikBiLL\Tests\Trait\InitTrait;
use PHPUnit\Framework\TestCase;

/**
 * Тестирование системы возврата данных клиента.
 * @cabinet - Клиентский запрос требующий токен клиента.
 */
class CabinetUserTest extends TestCase
{
	use InitTrait;

	private static MikBiLLApi $MikBiLL;
	private static bool $debug = false;
	private static string $signKey = "not-expected";
	private static ?string $token = "Bearer eyJ0eXAiOi.JKV1QiLCJ.hbGciOiJIUzI.1NiJ9";
	private static string $dataFile = __DIR__ . "/Responses/valid/Cabinet/user/user.get.json";

	public function test_1($expected = 1639): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserId());
	}

	public function test_2($expected = "Иванько Петр Петрович"): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getAsArray()["fio"]); # Классический вариант извлечения.
	}

	public function test_3($expected = "Петр"): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserFirstName());
	}

	public function test_4($expected = "Петрович"): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserMiddleName());
	}

	public function test_5($expected = "Иванько"): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserLastName());
	}

	public function test_6($expected = "оптика_5Mb"): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getData("packet_name")); # Второй вариант извлечения из массива.
	}

}
