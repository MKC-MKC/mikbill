<?php

namespace Haikiri\MikBiLL\Cabinet\Common;

use DateTimeImmutable;

class GetServerDateModel
{

	private array $data;

	public function __construct(array $data)
	{
		$this->data = $data;
	}

	public function getData(): array
	{
		return $this->data ?? [];
	}

	public function getDate(): ?string
	{
		return (string)$this->getData()["date"] ?? null;
	}

	public function getTimeStamp(): ?string
	{
		return (string)$this->getData()["timestamp"] ?? null;
	}

	public function getFormat(): ?string
	{
		return (string)$this->getData()["format"] ?? null;
	}

	public function getDay(): ?string
	{
		return (string)$this->getData()["day"] ?? null;
	}

	public function getMonth(): ?string
	{
		return (string)$this->getData()["month"] ?? null;
	}

	public function getDd(): ?string
	{
		return (string)$this->getData()["dd"] ?? null;
	}

	public function getTime(): ?string
	{
		return (string)$this->getData()["time"] ?? null;
	}

	public function getYear(): ?string
	{
		return (string)$this->getData()["year"] ?? null;
	}

	public function getNowDate(): ?string
	{
		return (string)$this->getData()["now_date"] ?? null;
	}

	public function getDateTime(): ?DateTimeImmutable
	{
		$dateString = $this->getData()["format"] ?? null;
		if (empty($dateString)) return null;

		return DateTimeImmutable::createFromFormat(format: "Y-m-d H:i:s", datetime: $dateString) ?: null;
	}

}
