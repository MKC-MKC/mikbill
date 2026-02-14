<?php

declare(strict_types=1);

namespace Tests\Haikiri\MikBiLL;

use Haikiri\MikBiLL\Exception\BillApiException;
use PHPUnit\Framework\TestCase;
use Tests\Haikiri\MikBiLL\Mock\CreateApi;
use Tests\Haikiri\MikBiLL\Mock\MikBiLLApiMock;

final class TicketsTest extends TestCase
{
	use CreateApi;

	private static bool $debug = false;
	protected static string $signKey = "not-expected";
	protected static ?string $token = "Bearer eyJ0eXAiOi.JKV1QiLCJ.hbGciOiJIUzI.1NiJ9";

	/**
	 * Получаем дату первого тикета.
	 * @return void
	 * @throws BillApiException
	 */
	public function testGetFirstTicketDate()
	{
		$MikBiLL = self::fromFile(__DIR__ . "/Responses/valid/Cabinet/tickets/tickets.get.json");
		$tickets = $MikBiLL->cabinet->Tickets()->getTickets();

		self::assertSame("14.11.2022 в 15:17:36", $tickets[0]->getDate()?->format("d.m.Y в H:i:s"));
	}

	/**
	 * Создаём новый тикет.
	 * @return void
	 * @throws BillApiException
	 * @noinspection SpellCheckingInspection
	 */
	public function testNewTicket()
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
		$MikBiLL = new MikBiLLApiMock(
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
		self::assertEquals($expected, $response->getId());
	}

	/**
	 * Просмотр тикета.
	 * @return void
	 * @throws BillApiException
	 */
	public function testViewTicketMessage()
	{
		# Имитируем получение ответа от API.
		$MikBiLL = self::fromFile(__DIR__ . "/Responses/valid/Cabinet/tickets/tickets.get-ID.json");

		# Выполняем запрос в биллинг.
		$dialog = $MikBiLL->cabinet->Tickets()->getTicketsDialog("Тут ваш ID тикета");

		# Можете посмотреть на массив, если включен debug.
		if (self::$debug) {
			foreach ($dialog as $ticket) {
				$type = $ticket->isMessageFromClient() ? "клиент" : "оператор";

				$name = $ticket->isMessageFromClient()
					? trim("{$ticket->getUserFirstName()} {$ticket->getUserMiddleName()}")
					: $ticket->getOperatorLogin();

				echo "<hr><p>[Сообщение №{$ticket->getMessageId()}] написал $type <b>$name</b></p>";
				echo "<p>Сообщение:</p><code>{$ticket->getMessageTest()}</code>";
				echo str_repeat(PHP_EOL, 2);
			}
		}

		self::assertSame("Сообщение с которым будет открыт тикет.", $dialog[0]->getMessageTest());
	}

}
