<?php

declare(strict_types=1);

namespace Haikiri\MikBiLL\Cabinet\Reports;

use DateTime;
use Exception;
use Haikiri\MikBiLL\ResponseWrapper;

class Payment extends ResponseWrapper
{

	public function getDate(): DateTime|null
	{
		try {
			return new DateTime($this->getData("date", ""));
		} catch (Exception) {
			return null;
		}
	}

	public function getId(): int
	{
		return (int)$this->getData("bughtypeid");
	}

	public function getName(): string
	{
		return $this->getData("bugh_type", "");
	}

	public function getBeforeBilling(): float
	{
		return (float)$this->getData("before_billing");
	}

	public function getSign(): string
	{
		return $this->getSignRaw();
	}

	/**
	 * Используйте этот метод, чтобы вернуть данные "как-есть".
	 * @return string
	 */
	public function getSignRaw(): string
	{
		return $this->getData("sign", "N/A");
	}

	public function getSumma(): int
	{
		return (int)$this->getData("summa");
	}

	public function getComment(): string
	{
		return $this->getData("comment", "");
	}

}
