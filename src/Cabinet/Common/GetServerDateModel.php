<?php

namespace Haikiri\MikBiLL\Cabinet\Common;

use Exception;
use DateTimeZone;
use DateTimeImmutable;
use Haikiri\MikBiLL\ResponseWrapper;

class GetServerDateModel extends ResponseWrapper
{

	public function getDate(): string|null
	{
		return $this->getData("date");
	}

	public function getTimeStamp(): string|null
	{
		return $this->getData("timestamp");
	}

	public function getFormat(): string|null
	{
		return $this->getData("format");
	}

	public function getDay(): string|null
	{
		return $this->getData("day");
	}

	public function getMonth(): string|null
	{
		return $this->getData("month");
	}

	public function getDd(): string|null
	{
		return $this->getData("dd");
	}

	public function getTime(): string|null
	{
		return $this->getData("time");
	}

	public function getYear(): string|null
	{
		return $this->getData("year");
	}

	public function getNowDate(): string|null
	{
		return $this->getData("now_date");
	}

	public function getDateTime($to = "utc"): DateTimeImmutable|bool
	{
		try {
			$timestamp = $this->getTimeStamp();
			$timezone = new DateTimeZone(timezone: $to);

			return (new DateTimeImmutable("@" . $timestamp))->setTimezone($timezone);
		} catch (Exception) {
			return false;
		}
	}

}
