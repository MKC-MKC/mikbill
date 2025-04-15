<?php

namespace Haikiri\MikBiLL\Cabinet\Packet;

class Packets
{

	private array|null $data;
	private array|null $items;

	public function __construct(?array $data = [])
	{
		$this->data = $data;
		$this->items = array_map(fn($i) => new PacketsModel($i), $data);
	}

	/**
	 * Метод возвращает результат как массив.
	 *
	 * @return array|null
	 */
	public function getAsArray(): ?array
	{
		return $this->data;
	}

	/**
	 * Метод возвращает результат как модель.
	 *
	 * @return PacketsModel[]
	 */
	public function getPacket(): array
	{
		return $this->items;
	}

}
