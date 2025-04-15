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

	public function getArray(): array
	{
		return $this->data ?? [];
	}

	public function getDate(): ?string
	{
		return (string)$this->getArray()["date"] ?? null;
	}

	public function getTimeStamp(): ?string
	{
		return (string)$this->getArray()["timestamp"] ?? null;
	}

	public function getFormat(): ?string
	{
		return (string)$this->getArray()["format"] ?? null;
	}

	public function getDay(): ?string
	{
		return (string)$this->getArray()["day"] ?? null;
	}

	public function getMonth(): ?string
	{
		return (string)$this->getArray()["month"] ?? null;
	}

	public function getDd(): ?string
	{
		return (string)$this->getArray()["dd"] ?? null;
	}

	public function getTime(): ?string
	{
		return (string)$this->getArray()["time"] ?? null;
	}

	public function getYear(): ?string
	{
		return (string)$this->getArray()["year"] ?? null;
	}

	public function getNowDate(): ?string
	{
		return (string)$this->getArray()["now_date"] ?? null;
	}

	public function getDateTime(): ?DateTimeImmutable
	{
		$dateString = $this->getArray()["format"] ?? null;
		if (empty($dateString)) return null;

		return DateTimeImmutable::createFromFormat(format: "Y-m-d H:i:s", datetime: $dateString) ?: null;
	}

}
