<?php /** @noinspection SpellCheckingInspection */

declare(strict_types=1);

namespace Haikiri\MikBiLL\Cabinet\Tickets;

use DateTimeImmutable;
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
		return $this->getData("ticketid", 0);
	}

	/**
	 * Метод возвращает ID статуса тикета.
	 * Например: 1 - "opened", 2 - "closed", ...? Нет официального описания.
	 *
	 * @return int
	 */
	public function getStatusTypeId(): int
	{
		return $this->getData("statustypeid", 0);
	}

	/**
	 * Метод возвращает название статуса тикета.
	 * Например: "opened"
	 *
	 * @return string
	 */
	public function getStatusTypeName(): string
	{
		return $this->getData("statustypename", "");
	}

	/**
	 * Метод возвращает ID приоритета тикета.
	 * Например: 2 - "normal", ...? Нет официального описания.
	 *
	 * @return int
	 */
	public function getPriorityTypeId(): int
	{
		return $this->getData("prioritytypeid", 0);
	}

	/**
	 * Метод возвращает название приоритета тикета.
	 * Например: "normal"
	 *
	 * @return string
	 */
	public function getPriorityTypeName(): string
	{
		return $this->getData("prioritytypename", "");
	}

	/**
	 * Метод возвращает дату создания тикета.
	 *
	 * @return DateTimeImmutable|null
	 */
	public function getDate(): ?DateTimeImmutable
	{
		$dateString = $this->getData("creationdate");
		if ($dateString === null) return null;

		return DateTimeImmutable::createFromFormat("Y-m-d H:i:s", $dateString) ?: null;
	}

	/**
	 * Метод возвращает первое сообщение тикета.
	 *
	 * @return string
	 */
	public function getMessage(): string
	{
		return $this->getData("first_message", "");
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
