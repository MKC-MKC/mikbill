<?php

namespace Haikiri\MikBiLL\Cabinet\Tickets;

class Ticket {
	private		array|null				$data;
	private		array|null				$items;

	public function __construct(?array $data = []) {
		$this->data = $data;
		$this->items = array_map(fn($i) => new TicketModel($i), $data);
	}

	/**
	 * Метод возвращает результат как массив.
	 * @return array|null
	 */
	public function getAsArray(): ?array {
		return $this->data;
	}

	/**
	 * Метод возвращает результат как модель.
	 * @return TicketModel[]
	 */
	public function getMessages(): array {
		return $this->items;
	}

}