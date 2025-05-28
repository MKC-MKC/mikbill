<?php

declare(strict_types=1);

namespace Haikiri\MikBiLL\Tests;

use Haikiri\MikBiLL\Tests\Mock\MikBiLLApiMock as MikBiLLApi;
use PHPUnit\Framework\TestCase;

/**
 * Тестирование системы тикетов.
 * @cabinet - Клиентские запросы требуют токен клиента.
 */
class TicketsTest extends TestCase
{
	private static MikBiLLApi $MikBiLL;
	private static bool $debug = false;
	private static string $signKey = "not-expected";
	private static ?string $token = "Bearer eyJ0eXAiOi.JKV1QiLCJ.hbGciOiJIUzI.1NiJ9";

	public static function processData($path): void
	{
		# Подготовка тестовых данных.
		$json = file_get_contents($path);

		# Инициализация MikBiLL SDK.
		self::$MikBiLL = new MikBiLLApi(
			url: "http://api.mikbill.local",
			key: self::$signKey,
			mockedData: $json,
		);

		# Записываем токен пользователя.
		self::$MikBiLL->setUserToken(self::$token);
	}

	/**
	 * Клиент может увидеть список своих тикетов.
	 */
	public function test_view_tickets($expected = "14.11.2022 в 15:17:36")
	{
		# Имитируем получение ответа от API.
		self::processData(path: __DIR__ . "/Responses/valid/Cabinet/tickets/tickets.get.json");

		# Выполняем запрос в биллинг.
		$response = self::$MikBiLL->cabinet->Tickets()->getTickets();

		# Можете посмотреть на массив, если включен debug.
		if (self::$debug) {
			foreach ($response as $ticket) {
				$status = $ticket->isClosed() ? "📛 [закрыто]" : "⏳ [открыто]";
				echo sprintf(
					"<hr><h2><small>%s</small> Обращение: <code>[id:%s]</code> | открыто %s</h2>",
					$status,
					$ticket->getId(),
					$ticket->getDate()?->format("d.m.Y в H:i:s") ?? ""
				);
				echo "<p>Первое сообщение:</p><code>{$ticket->getMessage()}</code>";
			}
		}

		# Для теста, сравниваем время создания первого тикета.
		$getOne = $response[0];
		$data = $getOne->getDate()?->format("d.m.Y в H:i:s");
		$this->assertEquals($expected, $data);
	}

	/**
	 * Клиент может создать новый тикет.
	 */
	public function test_new_ticket()
	{
		# Имитируем получение ответа от API.
		$json = json_encode(
			[
				"success" => true,
				"code" => 0,
				"data" => [
					"ticketid" => $expected = (string)rand(min: 1, max: 100) # Имитируем случайный ID тикета.
				]
			]
		);

		# Инициализируем Биллинг.
		$MikBiLL = new MikBiLLApi(
			url: "http://api.mikbill.local",
			key: self::$signKey,
			mockedData: $json,
		);

		# Записываем токен.
		$MikBiLL->setUserToken(self::$token);

		# Выполняем запрос в биллинг.
		$response = $MikBiLL->cabinet->Tickets()->newTicket("Сообщение с которым будет открыт тикет.");

		# Получаем ID нового тикета.
		$data = $response->getId();

		# Формируем ответное сообщение.
		$message = "Создан тикет ID: $data. Ожидался ID: $expected.";

		# Смотрим на результат если включен debug.
		if (self::$debug) echo $message . str_repeat(PHP_EOL, 2);

		# Сверяем результаты.
		$this->assertEquals($expected, $data, $message);
	}

	/**
	 * Клиент может видеть переписку с оператором.
	 */
	public function test_view_ticket_messages($expected = "Сообщение с которым будет открыт тикет.")
	{
		# Имитируем получение ответа от API.
		self::processData(path: __DIR__ . "/Responses/valid/Cabinet/tickets/tickets.get-ID.json");

		# Выполняем запрос в биллинг.
		$response = self::$MikBiLL->cabinet->Tickets()->getTicketsDialog("Тут ваш ID тикета");

		# Можете посмотреть на массив, если включен debug.
		if (self::$debug) {
			foreach ($response as $ticket) {
				$type = $ticket->isMessageFromClient() ? "клиент" : "оператор";

				$name = $ticket->isMessageFromClient()
					? trim("{$ticket->getUserFirstName()} {$ticket->getUserMiddleName()}")
					: $ticket->getOperatorLogin();

				echo "<hr><p>[Сообщение №{$ticket->getMessageId()}] написал $type <b>$name</b></p>";
				echo "<p>Сообщение:</p><code>{$ticket->getMessageTest()}</code>";
				echo str_repeat(PHP_EOL, 2);
			}
		}

		# Для теста получаем текст первого сообщения.
		$getOne = $response[0];
		$data = $getOne->getMessageTest();
		$this->assertEquals($expected, $data);
	}

}
