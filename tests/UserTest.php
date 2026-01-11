<?php /** @noinspection PhpUnhandledExceptionInspection */

namespace Tests\Haikiri\MikBiLL;

use PHPUnit\Framework\TestCase;
use Tests\Haikiri\MikBiLL\Mock\MikBiLLApiMock as MikBiLLApi;
use Tests\Haikiri\MikBiLL\Trait\InitTrait;

/**
 * Тестирование системы возврата данных авторизованного клиента.
 * @in-search - Данные доступные в методе поиска. Но эти здесь - немного отличаются.
 * @cabinet - Клиентские запросы требуют токен клиента.
 */
class UserTest extends TestCase
{
	use InitTrait;

	private static MikBiLLApi $MikBiLL;
	private static bool $debug = false;
	private static string $signKey = "not-expected";
	private static ?string $token = "Bearer eyJ0eXAiOi.JKV1QiLCJ.hbGciOiJIUzI.1NiJ9";
	private static string $dataFile = __DIR__ . "/Responses/valid/Cabinet/user/user.get.json";

	/** @in-search */
	public function test_34(): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame("1. Основной", $data->getUserSector());
	}

	/** @in-search */
	public function test_55(): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame("Мадрид, Тележкина 30/12", $data->getUserAddress());
	}

	public function test_56($expected = "руб"): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserCurrency());
	}

	public function test_57($expected = "оптика_5Mb"): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserTariffName());
	}

	public function test_58($expected = 5): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserTariffSpeedIn());
	}

	public function test_59($expected = 5): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserTariffSpeedOut());
	}

	public function test_60($expected = 400.0): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserTariffFixedCost());
	}

	public function test_61($expected = 10.0): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getFixedCostOnPerDay());
	}

	public function test_62($expected = 4030.0): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserCharge());
	}

	public function test_63($expected = "оптика_5Mb"): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getPacket());
	}

	public function test_64($expected = "оптика_5Mb"): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getPacketName());
	}

	public function test_65($expected = 24): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserTurboTime());
	}

	public function test_66($expected = false): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->isUserTurboActivated());
	}

	public function test_67($expected = true): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->isUserTurboDo());
	}

	public function test_68($expected = 15.0): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserCreditCost());
	}

	public function test_69($expected = true): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$data = count($data->getUserPaymentMethods()) > 3;
		$this->assertSame($expected, $data);
	}

	public function test_70($expected = true): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$data = count($data->getUserShow()) > 3;
		$this->assertSame($expected, $data);
	}

	public function test_71($expected = true): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$data = count($data->getUserFee()) > 3;
		$this->assertSame($expected, $data);
	}

	public function test_72($expected = 110): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$data = $data->getDaysLeft();
		$this->assertSame($expected, $data);
	}

	public function test_73(): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();

		$date = $data->getDateItog();
		$this->assertSame("16-05-2022", $date);

		$dateObj = $data->getEndDate();
		$this->assertSame("16.05.2022", $dateObj->format("d.m.Y"));

		$dateObj = $data->getEndDate();
		$this->assertSame("16-05-2022", $dateObj->format("d-m-Y"));
	}

}
