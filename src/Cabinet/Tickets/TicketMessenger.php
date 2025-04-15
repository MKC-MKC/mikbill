<?php

namespace Haikiri\MikBiLL\Cabinet\Tickets;

class TicketMessenger {
	private		array|null				$data;
	private		array|null				$items;

	public function __construct(?array $data = []) {
		$this->data = $data;
		$this->items = array_map(fn($i) => new TicketMessengerModel($i), $data);
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
	 * @return TicketMessengerModel[]
	 */
	public function getMessages(): array {
		return $this->items;
	}

}