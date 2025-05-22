<?php

namespace Haikiri\MikBiLL\Cabinet\Tickets;

use Haikiri\MikBiLL\ResponseWrapper;

class Ticket extends ResponseWrapper
{
	private array|null $items;

	public function __construct(?array $data)
	{
		parent::__construct($data);
		$this->items = array_map(fn($i) => new TicketModel($i), $data);
	}

	/**
	 * Метод возвращает результат как модель.
	 * @return TicketModel[]
	 */
	public function getMessages(): array
	{
		return $this->items;
	}

}
