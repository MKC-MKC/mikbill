<?php /** @noinspection PhpUnhandledExceptionInspection */

namespace Haikiri\MikBiLL\Tests;

use Haikiri\MikBiLL\Tests\Mock\MikBiLLApiMock as MikBiLLApi;
use Haikiri\MikBiLL\Tests\Trait\InitTrait;
use PHPUnit\Framework\TestCase;

/**
 * Тестирование системы возврата данных авторизованного клиента.
 * @in-search - Данные доступные в методе поиска.
 * @cabinet - Клиентские запросы требуют токен клиента.
 */
class UserTest extends TestCase
{
	use InitTrait;

	private static string $expected_test_34 = "1. Основной";
	private static string $expected_test_55 = "Мадрид, Тележкина 30/12";

	private static MikBiLLApi $MikBiLL;
	private static bool $debug = false;
	private static string $signKey = "not-expected";
	private static ?string $token = "Bearer eyJ0eXAiOi.JKV1QiLCJ.hbGciOiJIUzI.1NiJ9";
	private static string $dataFile = __DIR__ . "/Responses/valid/Cabinet/user/user.get.json";

	/** @in-search */
	public function test_1($expected = 1639): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserId());
	}

	/** @in-search */
	public function test_2($expected = 2): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserGid());
	}

	/** @in-search */
	public function test_3($expected = 0): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserDeletedId());
	}

	/** @in-search */
	public function test_4($expected = "username"): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserLogin());
	}

	/** @in-search */
	public function test_5($expected = "userpass"): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserPassword());
	}

	/** @in-search */
	public function test_6($expected = "1232"): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserDogovor());
	}

	/** @in-search */
	public function test_7($expected = "drhу"): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserNotes());
	}

	/** @in-search */
	public function test_8($expected = 375.82): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserDeposit());
	}

	/** @in-search */
	public function test_9($expected = 0.000000): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserTotalMoney());
	}

	/** @in-search */
	public function test_10($expected = 1): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserState());
	}

	/** @in-search */
	public function test_11($expected = false): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->isUserBlocked());
	}

	/** @in-search */
	public function test_12($expected = true): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->isUserActivated());
	}

	/** @in-search */
	public function test_13($expected = "Иванько Петр Петрович"): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getAsArray()["fio"]); # Классический вариант извлечения.
	}

	/** @in-search */
	public function test_14($expected = "Петр"): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserFirstName());
	}

	/** @in-search */
	public function test_15($expected = "Иванько"): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserLastName());
	}

	/** @in-search */
	public function test_16($expected = "Петрович"): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserMiddleName());
	}

	/** @in-search */
	public function test_17($expected = "11.02.2020"): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserBirthday()?->format("d.m.Y"));
	}

	/** @in-search */
	public function test_18($expected = true): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->isUserBirthdayDo());
	}

	/** @in-search */
	public function test_19($expected = 5120): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserSpeedRate());
	}

	/** @in-search */
	public function test_20($expected = 5120): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserSpeedBurst());
	}

	/** @in-search */
	public function test_21($expected = "info@wi-fi-point.com"): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserEmail());
	}

	/** @in-search */
	public function test_22($expected = ""): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserPhone());
	}

	/** @in-search */
	public function test_23($expected = "380934708280"): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserPhoneSms());
	}

	/** @in-search */
	public function test_24($expected = "380934708280"): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserPhoneMobile());
	}

	/** @in-search */
	public function test_25($expected = "19.07.2013"): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserAddDate()?->format("d.m.Y"));
	}

	/** @in-search */
	public function test_26($expected = null): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserDelDate()?->format("d.m.Y"));
	}

	/** @in-search */
	public function test_27($expected = "20.05.2025 07:56:17"): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserLastConnectionDate()?->format("d.m.Y H:i:s"));
	}

	/** @in-search */
	public function test_28($expected = "3251006556"): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserInn());
	}

	/** @in-search */
	public function test_29($expected = "_СЕРИЯ_"): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserPassportSeries());
	}

	/** @in-search */
	public function test_30($expected = "ЕДРИТ, г. Мадрид, ул. Тележкина, 30/12"): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserPassportRegistration());
	}

	/** @in-search */
	public function test_31($expected = ""): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserPassportVoenkomat());
	}

	/** @in-search */
	public function test_32($expected = "_ГДЕ И КОГДА_"): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserPassportAuthority());
	}

	/** @in-search */
	public function test_33($expected = 4294967295): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserSwitchPort());
	}

	/** @in-search */
	public function test_34(): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame(self::$expected_test_34, $data->getUserSector());
	}

	/** @in-search */
	public function test_35($expected = false): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->isUserUseRouter());
	}

	/** @in-search */
	public function test_36($expected = "TP-Link Corporat"): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserRouterModel());
	}

	/** @in-search */
	public function test_37($expected = ""): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserRouterSsid());
	}

	/** @in-search */
	public function test_38($expected = ""): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserRouterLogin());
	}

	/** @in-search */
	public function test_39($expected = ""): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserRouterPassword());
	}

	/** @in-search */
	public function test_40($expected = null): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserRouterAddDate()?->format("d.m.Y"));
	}

	/** @in-search */
	public function test_41($expected = "8080"): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserRouterPort());
	}

	/** @in-search */
	public function test_42($expected = ""): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserRouterSerialNumber());
	}

	/** @in-search */
	public function test_43($expected = false): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->isUserRouterAcquiredFromUs());
	}

	/** @in-search */
	public function test_44($expected = false): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->isUseDualRouter());
	}

	/** @in-search */
	public function test_45($expected = false): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->isUseDualRouter());
	}

	/** @in-search */
	public function test_46($expected = 4030): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserCredit());
	}

	/** @in-search */
	public function test_47($expected = 0): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserCreditPercent());
	}

	/** @in-search */
	public function test_48($expected = false): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->isCreditUnlimited());
	}

	/** @in-search */
	public function test_49($expected = false): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->isCreditUnlimited());
	}

	/** @in-search */
	public function test_50($expected = 0): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserRating());
	}

	/** @in-search */
	public function test_51($expected = "172.16.0.4"): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserFramedIp());
	}

	/** @in-search */
	public function test_52($expected = "255.255.255.255"): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserFramedMask());
	}

	/** @in-search */
	public function test_53($expected = "10.0.0.4"): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserLocalIp());
	}

	/** @in-search */
	public function test_54($expected = "AA:BB:CC:11:22:33"): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserLocalMac());
	}

	/** @in-search */
	public function test_55(): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame(self::$expected_test_55, $data->getUserAddress());
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
