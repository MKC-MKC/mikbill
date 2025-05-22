<?php

namespace Haikiri\MikBiLL\Cabinet\Tickets;

use Haikiri\MikBiLL\ResponseWrapper;

class NewTicketModel extends ResponseWrapper
{

	/**
	 * Метод возвращает ID только что созданного тикета.
	 * @return int|null
	 * @noinspection SpellCheckingInspection
	 */
	public function getId(): int|null
	{
		return $this->getData("ticketid");
	}

}
