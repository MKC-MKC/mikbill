<?php /** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

namespace Tests\Haikiri\MikBiLL;

use PHPUnit\Framework\TestCase;
use Tests\Haikiri\MikBiLL\Mock\MikBiLLApiMock as MikBiLLApi;
use Tests\Haikiri\MikBiLL\Trait\InitTrait;

/**
 * Тестирование поиска клиента и обработки его данных.
 * @billing - Административные запросы требуют подпись.
 */
class BillingSearchUsersTest extends TestCase
{
	use InitTrait;

	private static string $expected_test_34 = "91";
	private static string $expected_test_55 = "Мадрид Тележкина 30/12";

	private static MikBiLLApi $MikBiLL;
	private static bool $debug = false;
	private static string $signKey = "mockedSignKey";
	private static ?string $token = "not-expected";
	private static string $dataFile = __DIR__ . "/Responses/valid/Billing/Users/search.post.json";

	/**
	 * Поиск всех активных клиентов (state = 1).
	 *
	 * @in-search
	 * @noinspection PhpRedundantOptionalArgumentInspection
	 */
	public function test_search($expected = 1)
	{
		# Выполняем запрос в биллинг.
		$users = self::$MikBiLL->billing->Users()->searchUser(key: "state", value: $expected, operator: "=");

		# Можете посмотреть на массив, если включен debug.
		if (self::$debug) {
			echo "<h3>Список удалённых клиентов:</h3>";
			foreach ($users as $user) {
				echo "<h2>[uid: {$user->getUserId()}] – {$user->getUserFirstName()} {$user->getUserMiddleName()}</h2>";
			}
		}

		# Проверяем для теста одного пользователя на соответствие state = 1.
		$user = $users[0];
		$this->assertSame($expected, $user->getUserState());
	}

	/** @in-search */
	public function test_1($expected = 1639): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->getUserId());
	}

	/** @in-search */
	public function test_2($expected = 2): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->getUserGid());
	}

	/** @in-search */
	public function test_3($expected = 0): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->getUserDeletedId());
	}

	/** @in-search */
	public function test_4($expected = "username"): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->getUserLogin());
	}

	/** @in-search */
	public function test_5($expected = "userpass"): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->getUserPassword());
	}

	/** @in-search */
	public function test_6($expected = "1232"): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->getUserDogovor());
	}

	/** @in-search */
	public function test_7($expected = "drhу"): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->getUserNotes());
	}

	/** @in-search */
	public function test_8($expected = 375.82): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->getUserDeposit());
	}

	/** @in-search */
	public function test_9($expected = 0.000000): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->getUserTotalMoney());
	}

	/** @in-search */
	public function test_10($expected = 1): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->getUserState());
	}

	/** @in-search */
	public function test_11($expected = false): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->isUserBlocked());
	}

	/** @in-search */
	public function test_12($expected = true): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->isUserActivated());
	}

	/** @in-search */
	public function test_13($expected = "Иванько Петр Петрович"): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->getAsArray()["fio"]); # Классический вариант извлечения.
	}

	/** @in-search */
	public function test_14($expected = "Петр"): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->getUserFirstName());
	}

	/** @in-search */
	public function test_15($expected = "Иванько"): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->getUserLastName());
	}

	/** @in-search */
	public function test_16($expected = "Петрович"): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->getUserMiddleName());
	}

	/** @in-search */
	public function test_17($expected = "11.02.2020"): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->getUserBirthday()?->format("d.m.Y"));
	}

	/** @in-search */
	public function test_18($expected = true): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->isUserBirthdayDo());
	}

	/** @in-search */
	public function test_19($expected = 5120): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->getUserSpeedRate());
	}

	/** @in-search */
	public function test_20($expected = 5120): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->getUserSpeedBurst());
	}

	/** @in-search */
	public function test_21($expected = "info@wi-fi-point.com"): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->getUserEmail());
	}

	/** @in-search */
	public function test_22($expected = ""): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->getUserPhone());
	}

	/** @in-search */
	public function test_23($expected = "380934708280"): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->getUserPhoneSms());
	}

	/** @in-search */
	public function test_24($expected = "380934708280"): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->getUserPhoneMobile());
	}

	/** @in-search */
	public function test_25($expected = "19.07.2013"): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->getUserAddDate()?->format("d.m.Y"));
	}

	/** @in-search */
	public function test_26($expected = null): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->getUserDelDate()?->format("d.m.Y"));
	}

	/** @in-search */
	public function test_27($expected = "20.05.2025 07:56:17"): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->getUserLastConnectionDate()?->format("d.m.Y H:i:s"));
	}

	/** @in-search */
	public function test_28($expected = "3251006556"): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->getUserInn());
	}

	/** @in-search */
	public function test_29($expected = "_СЕРИЯ_"): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->getUserPassportSeries());
	}

	/** @in-search */
	public function test_30($expected = "ЕДРИТ, г. Мадрид, ул. Тележкина, 30/12"): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->getUserPassportRegistration());
	}

	/** @in-search */
	public function test_31($expected = ""): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->getUserPassportVoenkomat());
	}

	/** @in-search */
	public function test_32($expected = "_ГДЕ И КОГДА_"): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->getUserPassportAuthority());
	}

	/** @in-search */
	public function test_33($expected = 4294967295): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->getUserSwitchPort());
	}

	/** @in-search */
	public function test_34(): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame(self::$expected_test_34, $data->getUserSector());
	}

	/** @in-search */
	public function test_35($expected = false): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->isUserUseRouter());
	}

	/** @in-search */
	public function test_36($expected = "TP-Link Corporat"): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->getUserRouterModel());
	}

	/** @in-search */
	public function test_37($expected = ""): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->getUserRouterSsid());
	}

	/** @in-search */
	public function test_38($expected = ""): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->getUserRouterLogin());
	}

	/** @in-search */
	public function test_39($expected = ""): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->getUserRouterPassword());
	}

	/** @in-search */
	public function test_40($expected = null): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->getUserRouterAddDate()?->format("d.m.Y"));
	}

	/** @in-search */
	public function test_41($expected = "8080"): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->getUserRouterPort());
	}

	/** @in-search */
	public function test_42($expected = ""): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->getUserRouterSerialNumber());
	}

	/** @in-search */
	public function test_43($expected = false): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->isUserRouterAcquiredFromUs());
	}

	/** @in-search */
	public function test_44($expected = false): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->isUseDualRouter());
	}

	/** @in-search */
	public function test_45($expected = false): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->isUseDualRouter());
	}

	/** @in-search */
	public function test_46($expected = 4030): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->getUserCredit());
	}

	/** @in-search */
	public function test_47($expected = 0): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->getUserCreditPercent());
	}

	/** @in-search */
	public function test_48($expected = false): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->isCreditUnlimited());
	}

	/** @in-search */
	public function test_49($expected = false): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->isCreditUnlimited());
	}

	/** @in-search */
	public function test_50($expected = 0): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->getUserRating());
	}

	/** @in-search */
	public function test_51($expected = "172.16.0.4"): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->getUserFramedIp());
	}

	/** @in-search */
	public function test_52($expected = "255.255.255.255"): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->getUserFramedMask());
	}

	/** @in-search */
	public function test_53($expected = "10.0.0.4"): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->getUserLocalIp());
	}

	/** @in-search */
	public function test_54($expected = "AA:BB:CC:11:22:33"): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->getUserLocalMac());
	}

	/** @in-search */
	public function test_55($expected = "Мадрид Тележкина 30/12"): void
	{
		$data = self::$MikBiLL->billing->Users()->searchUser(value: "uid_клиента")[0];
		$this->assertSame($expected, $data->getUserAddress());
	}

}
