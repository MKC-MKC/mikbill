<?php

declare(strict_types=1);

namespace Haikiri\MikBiLL\Tests;

use Haikiri\MikBiLL\Tests\Mock\MikBiLLApiMock as MikBiLLApi;
use Haikiri\MikBiLL\Tests\Trait\InitTrait;
use PHPUnit\Framework\TestCase;

/** @billing - Административный запрос требующий подпись. */
class BillingUsersSearchTest extends TestCase
{
	use InitTrait;

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
	public function test($expected = 1)
	{
		# Выполняем запрос в биллинг.
		$searchResult = self::$MikBiLL->billing->Users()->searchUser(key: "state", value: $expected, operator: "=");

		# Получаем массив объектов.
		$users = $searchResult->getUsers();

		# Можете посмотреть на массив, если включен debug.
		if (self::$debug) {
			echo "<h3>Список удалённых клиентов:</h3>";
			foreach ($users as $user) {
				echo "<h2>[uid: {$user->getUserId()}] – {$user->getUserFirstName()} {$user->getUserMiddleName()}</h2>";
			}
		}

		# Проверяем для теста одного пользователя на соответствие state = 1.
		$user = $searchResult->getOne();
		$this->assertEquals($expected, $user->getUserState());
	}

}
