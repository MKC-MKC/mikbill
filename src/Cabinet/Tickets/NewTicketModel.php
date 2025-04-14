<?php

declare(strict_types=1);

namespace Haikiri\MikBiLL\Cabinet\Tickets;

class NewTicketModel {
	private		array|null				$data;

	public function __construct(?array $data = []) {
		$this->data = $data;
	}

	public function getData(): ?array {
		return $this->data ?? [];
	}

	/**
	 * Метод возвращает ID только что созданного тикета.
	 *
	 * @return int|null
	 * @noinspection SpellCheckingInspection
	 */
	public function getId(): ?int {
		return (int)$this->getData()["ticketid"] ?? null;
	}

}