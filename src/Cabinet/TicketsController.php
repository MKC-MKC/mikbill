<?php

namespace Haikiri\MikBiLL\Cabinet;

use Haikiri\MikBiLL\Exception;
use Haikiri\MikBiLL\MikBiLLApiInterface;

class TicketsController {
	protected		MikBiLLApiInterface				$billInterface;

	public function __construct(MikBiLLApiInterface $interface) {
		$this->billInterface = $interface;
	}

	/**
	 * Метод возвращает все тикеты клиента.
	 *
	 * @return object
	 * @throws Exception\UnauthorizedException|Exception\BillApiException
	 */
	public function getTickets(): object {
		$response = $this->billInterface->sendRequest(
			uri:		"/api/v1/cabinet/tickets",
			method:		"GET",
			token:		$this->billInterface->getUserToken(),
		);
		return new Tickets\Ticket($response["data"] ?? []);
	}

	/**
	 * Метод возвращает модель объект тикета.
	 *
	 * @param string $message
	 * @return Tickets\NewTicketModel
	 * @throws Exception\UnauthorizedException|Exception\BillApiException
	 */
	public function newTicket(string $message): object {
		$params = [
			"message"	=>	$message,
		];
		$response = $this->billInterface->sendRequest(
			uri:		"/api/v1/cabinet/tickets",
			params:		$params,
			token:		$this->billInterface->getUserToken(),
		);
		return new Tickets\NewTicketModel($response["data"] ?? []);
	}

	/**
	 * Метод возвращает модель объект тикета.
	 *
	 * @param string|int $ticketId
	 * @return object
	 * @throws Exception\UnauthorizedException|Exception\BillApiException
	 */
	public function getTicketsDialog(string|int $ticketId): object {
		$response = $this->billInterface->sendRequest(
			uri:		"/api/v1/cabinet/tickets/$ticketId",
			method:		"GET",
			token:		$this->billInterface->getUserToken(),
		);
		return new Tickets\TicketMessenger($response["data"] ?? []);
	}

	/**
	 * Метод отправляет сообщение в тикет.
	 *
	 * @param string|int $ticketId
	 * @param string $message
	 * @return bool
	 * @throws Exception\UnauthorizedException|Exception\BillApiException
	 */
	public function sendMessage(string|int $ticketId, string $message): bool {
		$params = [
			"message"	=>	$message,
		];
		$response = $this->billInterface->sendRequest(
			uri:		"/api/v1/cabinet/tickets/$ticketId",
			params:		$params,
			token:		$this->billInterface->getUserToken(),
		);
		return isset($response["success"]) && $response["success"] == 1;
	}

}