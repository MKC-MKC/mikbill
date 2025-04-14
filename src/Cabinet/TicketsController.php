<?php

namespace Haikiri\MikBiLL\Cabinet;

use Haikiri\MikBiLL\MikBiLLApiInterface;
use Haikiri\MikBiLL\Exception\InvalidTokenException;

class TicketsController {
	protected		MikBiLLApiInterface				$billInterface;

	public function __construct(MikBiLLApiInterface $interface) {
		$this->billInterface = $interface;
	}

	/**
	 * Метод возвращает все тикеты клиента.
	 *
	 * @return Tickets\Ticket
	 * @throws InvalidTokenException
	 */
	public function getTickets(): Tickets\Ticket {
		if (empty($this->billInterface->getUserToken())) throw new InvalidTokenException("The token was not found: The storage with token is empty.");
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
	 * @throws InvalidTokenException
	 */
	public function newTicket(string $message): Tickets\NewTicketModel {
		$params = [
			"message"	=>	$message,
		];
		if (empty($this->billInterface->getUserToken())) throw new InvalidTokenException("The token was not found: The storage with token is empty.");
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
	 * @return Tickets\TicketMessenger
	 * @throws InvalidTokenException
	 */
	public function getTicketsDialog(string|int $ticketId): Tickets\TicketMessenger {
		if (empty($this->billInterface->getUserToken())) throw new InvalidTokenException("The token was not found: The storage with token is empty.");
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
	 * @throws InvalidTokenException
	 */
	public function sendMessage(string|int $ticketId, string $message): bool {
		if (empty($this->billInterface->getUserToken())) throw new InvalidTokenException("The token was not found: The storage with token is empty.");
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