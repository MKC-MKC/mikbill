<?php

namespace Haikiri\MikBiLL\Cabinet\Tickets;

use DateTime;
use Exception;
use Haikiri\MikBiLL\ResponseWrapper;

class TicketModel extends ResponseWrapper
{
	public const OPENED = 1;
	public const CLOSED = 2;

	/**
	 * Метод возвращает ID тикета.
	 *
	 * @return int
	 */
	public function getId(): int
	{
		return (int)$this->getData("ticketid");
	}

	/**
	 * Метод возвращает ID статуса тикета.
	 * Например: 1 - "opened", 2 - "closed", ...? Нет официального описания.
	 *
	 * @return int
	 */
	public function getStatusTypeId(): int
	{
		return (int)$this->getData("statustypeid");
	}

	/**
	 * Метод возвращает название статуса тикета.
	 * Например: "opened"
	 *
	 * @return string
	 */
	public function getStatusTypeName(): string
	{
		return (string)$this->getData("statustypename");
	}

	/**
	 * Метод возвращает ID приоритета тикета.
	 * Например: 2 - "normal", ...? Нет официального описания.
	 *
	 * @return int
	 */
	public function getPriorityTypeId(): int
	{
		return (int)$this->getData("prioritytypeid");
	}

	/**
	 * Метод возвращает название приоритета тикета.
	 * Например: "normal"
	 *
	 * @return string
	 */
	public function getPriorityTypeName(): string
	{
		return (string)$this->getData("prioritytypename");
	}

	/**
	 * Метод возвращает дату создания тикета.
	 *
	 * @return DateTime|null
	 */
	public function getDate(): DateTime|null
	{
		try {
			return new DateTime($this->getData("creationdate", ""));
		} catch (Exception) {
			return null;
		}
	}

	/**
	 * Метод возвращает первое сообщение тикета.
	 *
	 * @return string
	 */
	public function getMessage(): string
	{
		return (string)$this->getData("first_message");
	}

	/**
	 * Является ли тикет закрытым?
	 *
	 * @return bool
	 */
	public function isClosed(): bool
	{
		return $this->getStatusTypeId() == self::CLOSED;
	}

}
