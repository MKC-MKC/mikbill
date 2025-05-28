<?php

namespace Haikiri\MikBiLL\Cabinet\Common;

use DateTime;
use Exception;
use Haikiri\MikBiLL\ResponseWrapper;

class GetServerDate extends ResponseWrapper
{

	public function getDate(): string
	{
		return (string)$this->getData("date");
	}

	public function getTimeStamp(): int
	{
		return (int)$this->getData("timestamp", 0);
	}

	public function getFormat(): string
	{
		return (string)$this->getData("format");
	}

	public function getDay(): string
	{
		return (string)$this->getData("day");
	}

	public function getMonth(): string
	{
		return (string)$this->getData("month");
	}

	public function getDd(): string
	{
		return (string)$this->getData("dd");
	}

	public function getTime(): string
	{
		return (string)$this->getData("time");
	}

	public function getYear(): string
	{
		return (string)$this->getData("year");
	}

	public function getNowDate(): string
	{
		return (string)$this->getData("now_date");
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
