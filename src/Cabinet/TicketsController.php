<?php

namespace Haikiri\MikBiLL\Cabinet;

use Haikiri\MikBiLL\Exception;
use Haikiri\MikBiLL\MikBiLLApiInterface;

class TicketsController
{
	protected MikBiLLApiInterface $billInterface;

	public function __construct(MikBiLLApiInterface $interface)
	{
		$this->billInterface = $interface;
	}

	/**
	 * Метод возвращает массив объектов тикета клиента.
	 *
	 * @return Tickets\Ticket[]
	 * @throws Exception\BillApiException
	 * @see https://documenter.getpostman.com/view/5969645/TVCfXTtK#dc173a89-274f-4741-aee0-a700ac28d88d
	 */
	public function getTickets(): array
	{
		$response = $this->billInterface->sendRequest(
			uri: "/api/v1/cabinet/tickets",
			method: "GET",
			token: $this->billInterface->getUserToken(),
		);

		return array_map(fn(array $item): Tickets\Ticket => new Tickets\Ticket($item), $response->getData());
	}

	/**
	 * Метод возвращает модель объект тикета.
	 *
	 * @param string $message
	 * @return Tickets\NewTicket
	 * @throws Exception\BillApiException
	 * @see https://documenter.getpostman.com/view/5969645/TVCfXTtK#ad86043a-0f71-43ff-b9c3-3963fc944ec1
	 */
	public function newTicket(string $message): object
	{
		$params = [
			"message" => $message,
		];

		$response = $this->billInterface->sendRequest(
			uri: "/api/v1/cabinet/tickets",
			params: $params,
			token: $this->billInterface->getUserToken(),
		);

		return new Tickets\NewTicket($response->getData());
	}

	/**
	 * Метод возвращает массив объектов сообщения тикета.
	 *
	 * @param $ticketId
	 * @return Tickets\TicketMessage[]
	 * @throws Exception\BillApiException
	 * @see https://documenter.getpostman.com/view/5969645/TVCfXTtK#d794ec97-fcfc-4857-ad42-24b874c831c3
	 */
	public function getTicketsDialog($ticketId): array
	{
		$response = $this->billInterface->sendRequest(
			uri: "/api/v1/cabinet/tickets/$ticketId",
			method: "GET",
			token: $this->billInterface->getUserToken(),
		);

		return array_map(fn(array $item): Tickets\TicketMessage => new Tickets\TicketMessage($item), $response->getData());
	}

	/**
	 * Метод отправляет сообщение в тикет.
	 *
	 * @param $ticketId
	 * @param string $message
	 * @return bool
	 * @throws Exception\BillApiException
	 * @see https://documenter.getpostman.com/view/5969645/TVCfXTtK#98ae7817-8b46-4eec-8ce6-f59373e39ba8
	 */
	public function sendMessage($ticketId, string $message): bool
	{
		$params = [
			"message" => $message,
		];

		$response = $this->billInterface->sendRequest(
			uri: "/api/v1/cabinet/tickets/$ticketId",
			params: $params,
			token: $this->billInterface->getUserToken(),
		);

		return $response->isSuccess();
	}

}
