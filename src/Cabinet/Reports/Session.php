<?php

namespace Haikiri\MikBiLL\Cabinet\Reports;

use DateTime;
use Exception;
use Haikiri\MikBiLL\ResponseWrapper;

class Session extends ResponseWrapper
{

	public function getStartDateTime(): DateTime|null
	{
		try {
			$date = $this->getData("start_time");
			if (empty($date)) return null;
			return new DateTime($date);
		} catch (Exception) {
			return null;
		}
	}

	public function getStopDateTime(): DateTime|null
	{
		try {
			$date = $this->getData("stop_time");
			if (empty($date)) return null;
			return new DateTime($date);
		} catch (Exception) {
			return null;
		}
	}

	public function getUsername(): string
	{
		return $this->getData("username", "");
	}

	public function getBillingBefore(): float
	{
		return (float)$this->getData("before_billing");
	}

	public function getBillingMinus(): float
	{
		return (float)$this->getData("billing_minus");
	}

	public function getTimeOn(): int
	{
		return (int)$this->getData("time_on");
	}

	public function getCallFrom(): string
	{
		return $this->getData("call_from", "");
	}

	public function getIn(): float
	{
		return (float)$this->getData("in_bytes");
	}

	public function getOut(): float
	{
		return (float)$this->getData("out_bytes");
	}

	public function getIpAddress(): string
	{
		return $this->getData("ipaddress", "");
	}

	public function getFramedIpAddress(): string
	{
		return $this->getData("framedipaddress", "");
	}

}
