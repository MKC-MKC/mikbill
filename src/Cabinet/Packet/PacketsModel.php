<?php

namespace Haikiri\MikBiLL\Cabinet\Packet;

class PacketsModel
{

	private array $data;

	public function __construct(array $data)
	{
		$this->data = $data;
	}

	public function getData(): ?array
	{
		return $this->data ?? [];
	}

	public function getId(): int
	{
		return (int)$this->getData()["gid"] ?? 0;
	}

	public function getNum(): int
	{
		return (int)$this->getData()["num"] ?? 0;
	}

	public function getName(): string
	{
		return (string)$this->getData()["packet"] ?? "";
	}

	public function getPrice(): float
	{
		return (float)$this->getData()["full_price"] ?? 0.0;
	}

	public function getPriceDiscounted(): float
	{
		return (float)$this->getData()["full_price_discounted"] ?? 0.0;
	}

	public function getCurrency(): string
	{
		return (string)$this->getData()["currency"] ?? "";
	}

	public function getDoPerevodAkciya(): int
	{
		return (int)$this->getData()["do_perevod_akciya"] ?? 0;
	}

	public function getDoPerevodAkciyaCena(): int
	{
		return (int)$this->getData()["do_perevod_akciya_cena"] ?? 0;
	}

	public function getResidualPrice(): int
	{
		return (int)$this->getData()["residual_price"] ?? 0;
	}

	public function getResidualPriceDiscounted(): float
	{
		return (float)$this->getData()["residual_price_discounted"] ?? 0.0;
	}

}