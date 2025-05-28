<?php /** @noinspection SpellCheckingInspection */

namespace Haikiri\MikBiLL\Cabinet\Tickets;

use DateTime;
use Exception;
use Haikiri\MikBiLL\ResponseWrapper;

class TicketMessengerModel extends ResponseWrapper
{

	/**
	 * Метод возвращает ID сообщения.
	 *
	 * @return int
	 */
	public function getMessageId(): int
	{
		return (int)$this->getData("messageid");
	}

	/**
	 * Метод возвращает ID тикета.
	 *
	 * @return int
	 */
	public function getTicketId(): int
	{
		return (int)$this->getData("ticketid");
	}

	/**
	 * Метод возвращает ID клиента.
	 *
	 * @return int
	 */
	public function getUserId(): int
	{
		return (int)$this->getData("useruid");
	}

	/**
	 * Метод проверяет, отправлено ли сообщение клиентом.
	 *
	 * @return bool
	 */
	public function isMessageFromClient(): bool
	{
		return (bool)$this->getUserId() ?? false;
	}

	/**
	 * Метод возвращает ID оператора?
	 *
	 * @return int
	 */
	public function getStuffId(): int
	{
		return (int)$this->getData("stuffid");
	}

	/**
	 * Является ли сообщение непрочитанным.
	 *
	 * @return bool
	 */
	public function isMessageUnread(): bool
	{
		return (bool)$this->getData("unread");
	}

	/**
	 * Метод возвращает текст сообщения.
	 *
	 * @return string
	 */
	public function getMessageTest(): string
	{
		return (string)$this->getData("message");
	}

	/**
	 * Метод возвращает ФИО клиента.
	 *
	 * @return string
	 */
	public function getFIO(): string
	{
		return (string)$this->getData("fio");
	}

	/**
	 * Метод возвращает имя клиента.
	 *
	 * @return string
	 */
	public function getUserFirstName(): string
	{
		$fioParts = explode(" ", $this->getFIO());
		return $fioParts[1] ?? "";
	}

	/**
	 * Метод возвращает фамилию клиента.
	 *
	 * @return string
	 */
	public function getUserLastName(): string
	{
		$fioParts = explode(" ", $this->getFIO());
		return $fioParts[0] ?? "";
	}

	/**
	 * Метод возвращает отчество клиента.
	 *
	 * @return string
	 */
	public function getUserMiddleName(): string
	{
		$fioParts = explode(" ", $this->getFIO());
		return $fioParts[2] ?? "";
	}

	/**
	 * Метод возвращает логин клиента.
	 *
	 * @return string
	 */
	public function getUserLogin(): string
	{
		return (string)$this->getData("user");
	}

	/**
	 * Метод возвращает логин оператора.
	 *
	 * @return string
	 */
	public function getOperatorLogin(): string
	{
		return (string)$this->getData("login");
	}

	/**
	 * Метод возвращает время написания сообщения.
	 *
	 * @return DateTime|null
	 */
	public function getDate(): DateTime|null
	{
		try {
			return new DateTime($this->getData("date", ""));
		} catch (Exception) {
			return null;
		}
	}

}
