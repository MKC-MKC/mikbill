<?php

namespace Haikiri\MikBiLL\Cabinet\Common;

use DateTime;
use Exception;
use Haikiri\MikBiLL\ResponseWrapper;

class GetServerDateModel extends ResponseWrapper
{

	public function getDate(): string
	{
		return $this->getData("date", "");
	}

	public function getTimeStamp(): int
	{
		return (int)$this->getData("timestamp", 0);
	}

	public function getFormat(): string
	{
		return $this->getData("format", "");
	}

	public function getDay(): string
	{
		return $this->getData("day", "");
	}

	public function getMonth(): string
	{
		return $this->getData("month", "");
	}

	public function getDd(): string
	{
		return $this->getData("dd", "");
	}

	public function getTime(): string
	{
		return $this->getData("time", "");
	}

	public function getYear(): string
	{
		return $this->getData("year", "");
	}

	public function getNowDate(): string
	{
		return $this->getData("now_date", "");
	}

	public function getDateTime(): DateTime|null
	{
		try {
			return new DateTime("@{$this->getTimeStamp()}");
		} catch (Exception) {
			return null;
		}
	}

}
