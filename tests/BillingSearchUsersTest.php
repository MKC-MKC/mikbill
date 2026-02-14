<?php

declare(strict_types=1);

namespace Tests\Haikiri\MikBiLL;

use Haikiri\MikBiLL\Exception\BillApiException;
use PHPUnit\Framework\TestCase;
use Tests\Haikiri\MikBiLL\Mock\CreateApi;

/**
 * Тестирование поиска клиента и обработки его данных.
 * @billing - Административные запросы требуют подпись.
 */
final class BillingSearchUsersTest extends TestCase
{
	use CreateApi;

	protected static string $signKey = "mockedSignKey";
	protected static ?string $token = "not-expected";
	private static string $dataFile = __DIR__ . "/Responses/valid/Billing/Users/search.post.json";

	/**
	 * Поиск всех активных клиентов (state = 1).
	 * @throws BillApiException
	 * @in-search
	 */
	public function test_search(): void
	{
		# Инициализация SDK.
		$MikBiLL = self::fromFile(self::$dataFile);

		# Выполняем запрос в биллинг.
		$users = $MikBiLL->billing->Users()->searchUser(key: "state", value: 1, operator: "=");

		self::assertNotEmpty($users);
		self::assertSame(1, $users[0]->getUserState());
	}

	/**
	 * @throws BillApiException
	 * @noinspection SpellCheckingInspection
	 */
	public function testSearchResultPayloadIsMappedCorrectly(): void
	{
		# Инициализация SDK.
		$MikBiLL = self::fromFile(self::$dataFile);

		# Выполняем запрос в биллинг.
		$users = $MikBiLL->billing->Users()->searchUser(value: "uid_клиента");
		self::assertNotEmpty($users);

		# Сверяем первый объект с ожидаемыми значениями.
		$first = $users[0];
		$cases = [
			"getUserId" => [1639, fn() => $first->getUserId()],
			"getUserGid" => [2, fn() => $first->getUserGid()],
			"getUserDeletedId" => [0, fn() => $first->getUserDeletedId()],
			"getUserLogin" => ["username", fn() => $first->getUserLogin()],
			"getUserPassword" => ["userpass", fn() => $first->getUserPassword()],
			"getUserDogovor" => ["1232", fn() => $first->getUserDogovor()],
			"getUserNotes" => ["drhу", fn() => $first->getUserNotes()],
			"getUserDeposit" => [375.82, fn() => $first->getUserDeposit()],
			"getUserTotalMoney" => [0.0, fn() => $first->getUserTotalMoney()],
			"getUserState" => [1, fn() => $first->getUserState()],
			"isUserBlocked" => [false, fn() => $first->isUserBlocked()],
			"isUserActivated" => [true, fn() => $first->isUserActivated()],
			"fioFromArray" => ["Иванько Петр Петрович", fn() => $first->getAsArray()["fio"]],
			"getUserFirstName" => ["Петр", fn() => $first->getUserFirstName()],
			"getUserLastName" => ["Иванько", fn() => $first->getUserLastName()],
			"getUserMiddleName" => ["Петрович", fn() => $first->getUserMiddleName()],
			"getUserBirthday" => ["11.02.2020", fn() => $first->getUserBirthday()?->format("d.m.Y")],
			"isUserBirthdayDo" => [true, fn() => $first->isUserBirthdayDo()],
			"getUserSpeedRate" => [5120, fn() => $first->getUserSpeedRate()],
			"getUserSpeedBurst" => [5120, fn() => $first->getUserSpeedBurst()],
			"getUserEmail" => ["info@wi-fi-point.com", fn() => $first->getUserEmail()],
			"getUserPhone" => ["", fn() => $first->getUserPhone()],
			"getUserPhoneSms" => ["380934708280", fn() => $first->getUserPhoneSms()],
			"getUserPhoneMobile" => ["380934708280", fn() => $first->getUserPhoneMobile()],
			"getUserAddDate" => ["19.07.2013", fn() => $first->getUserAddDate()?->format("d.m.Y")],
			"getUserDelDate" => [null, fn() => $first->getUserDelDate()?->format("d.m.Y")],
			"getUserLastConnectionDate" => ["20.05.2025 07:56:17", fn() => $first->getUserLastConnectionDate()?->format("d.m.Y H:i:s")],
			"getUserInn" => ["3251006556", fn() => $first->getUserInn()],
			"getUserPassportSeries" => ["_СЕРИЯ_", fn() => $first->getUserPassportSeries()],
			"getUserPassportRegistration" => ["ЕДРИТ, г. Мадрид, ул. Тележкина, 30/12", fn() => $first->getUserPassportRegistration()],
			"getUserPassportVoenkomat" => ["", fn() => $first->getUserPassportVoenkomat()],
			"getUserPassportAuthority" => ["_ГДЕ И КОГДА_", fn() => $first->getUserPassportAuthority()],
			"getUserSwitchPort" => [4294967295, fn() => $first->getUserSwitchPort()],
			"getUserSector" => ["91", fn() => $first->getUserSector()],
			"isUserUseRouter" => [false, fn() => $first->isUserUseRouter()],
			"getUserRouterModel" => ["TP-Link Corporat", fn() => $first->getUserRouterModel()],
			"getUserRouterSsid" => ["", fn() => $first->getUserRouterSsid()],
			"getUserRouterLogin" => ["", fn() => $first->getUserRouterLogin()],
			"getUserRouterPassword" => ["", fn() => $first->getUserRouterPassword()],
			"getUserRouterAddDate" => [null, fn() => $first->getUserRouterAddDate()?->format("d.m.Y")],
			"getUserRouterPort" => ["8080", fn() => $first->getUserRouterPort()],
			"getUserRouterSerialNumber" => ["", fn() => $first->getUserRouterSerialNumber()],
			"isUserRouterAcquiredFromUs" => [false, fn() => $first->isUserRouterAcquiredFromUs()],
			"isUseDualRouter" => [false, fn() => $first->isUseDualRouter()],
			"getUserCredit" => [4030, fn() => $first->getUserCredit()],
			"getUserCreditPercent" => [0, fn() => $first->getUserCreditPercent()],
			"isCreditUnlimited" => [false, fn() => $first->isCreditUnlimited()],
			"getUserRating" => [0, fn() => $first->getUserRating()],
			"getUserFramedIp" => ["172.16.0.4", fn() => $first->getUserFramedIp()],
			"getUserFramedMask" => ["255.255.255.255", fn() => $first->getUserFramedMask()],
			"getUserLocalIp" => ["10.0.0.4", fn() => $first->getUserLocalIp()],
			"getUserLocalMac" => ["AA:BB:CC:11:22:33", fn() => $first->getUserLocalMac()],
			"getUserAddress" => ["Мадрид Тележкина 30/12", fn() => $first->getUserAddress()],
		];

		foreach ($cases as $label => [$expected, $actual]) {
			self::assertSame($expected, $actual(), $label);
		}
	}

}
