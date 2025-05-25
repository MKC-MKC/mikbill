<?php

namespace Haikiri\MikBiLL\Cabinet\Tickets;

use Haikiri\MikBiLL\ResponseWrapper;

class NewTicketModel extends ResponseWrapper
{

	/**
	 * Метод возвращает ID только что созданного тикета.
	 * @return int
	 * @noinspection SpellCheckingInspection
	 */
	public function getId(): int
	{
		return (int)$this->getData("ticketid");
	}

}
