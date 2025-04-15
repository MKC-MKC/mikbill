<?php

namespace Haikiri\MikBiLL\Cabinet\Packet;

class PacketsModel
{

	private array $data;

	public function __construct(array $data)
	{
		$this->data = $data;
	}

	public function getArray(): ?array
	{
		return $this->data ?? [];
	}

	public function getId(): int
	{
		return (int)$this->getArray()["gid"] ?? 0;
	}

	public function getNum(): int
	{
		return (int)$this->getArray()["num"] ?? 0;
	}

	public function getName(): string
	{
		return (string)$this->getArray()["packet"] ?? "";
	}

	public function getPrice(): float
	{
		return (float)$this->getArray()["full_price"] ?? 0.0;
	}

	public function getPriceDiscounted(): float
	{
		return (float)$this->getArray()["full_price_discounted"] ?? 0.0;
	}

	public function getCurrency(): string
	{
		return (string)$this->getArray()["currency"] ?? "";
	}

	public function getDoPerevodAkciya(): int
	{
		return (int)$this->getArray()["do_perevod_akciya"] ?? 0;
	}

	public function getDoPerevodAkciyaCena(): int
	{
		return (int)$this->getArray()["do_perevod_akciya_cena"] ?? 0;
	}

	public function getResidualPrice(): int
	{
		return (int)$this->getArray()["residual_price"] ?? 0;
	}

	public function getResidualPriceDiscounted(): float
	{
		return (float)$this->getArray()["residual_price_discounted"] ?? 0.0;
	}

}