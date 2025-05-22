<?php

namespace Haikiri\MikBiLL\Cabinet\Tickets;

use Haikiri\MikBiLL\ResponseWrapper;

class TicketMessenger extends ResponseWrapper
{
	private array|null $items;

	public function __construct(?array $data)
	{
		parent::__construct($data);
		$this->items = array_map(fn($i) => new TicketMessengerModel($i), $data);
	}

	/**
	 * Метод возвращает результат как модель.
	 * @return TicketMessengerModel[]
	 */
	public function getMessages(): array
	{
		return $this->items;
	}

}
