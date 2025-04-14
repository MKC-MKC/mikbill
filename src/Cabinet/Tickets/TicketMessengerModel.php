<?php /** @noinspection SpellCheckingInspection */

namespace Haikiri\MikBiLL\Cabinet\Tickets;

use DateTimeImmutable;

class TicketMessengerModel {
	private		array|null				$data;

	public function __construct(?array $data = []) {
		$this->data = $data;
	}

	/**
	 * Метод возвращает массив данных сообщения.
	 *
	 * @return array|null
	 */
	public function getData(): ?array {
		return $this->data ?? [];
	}

	/**
	 * Метод возвращает ID сообщения.
	 *
	 * @return int
	 */
	public function getMessageId(): int {
		return (int)($this->getData()["messageid"] ?? 0);
	}

	/**
	 * Метод возвращает ID тикета.
	 *
	 * @return int
	 */
	public function getTicketId(): int {
		return (int)($this->getData()["ticketid"] ?? 0);
	}

	/**
	 * Метод возвращает ID клиента.
	 *
	 * @return int
	 */
	public function getUserId(): int {
		return (int)($this->getData()["useruid"] ?? 0);
	}

	/**
	 * Метод проверяет, отправлено ли сообщение клиентом.
	 *
	 * @return bool
	 */
	public function isMessageFromClient(): bool {
		return (boolean)($this->getUserId() ?? 0);
	}

	/**
	 * Метод возвращает ID оператора?
	 *
	 * @return int
	 */
	public function getStuffId(): int {
		return (int)($this->getData()["stuffid"] ?? 0);
	}

	/**
	 * Является ли сообщение непрочитанным.
	 *
	 * @return bool
	 */
	public function isMessageUnread(): bool {
		return (int)($this->getData()["unread"] ?? 0) === 1;
	}

	/**
	 * Метод возвращает текст сообщения.
	 *
	 * @return string
	 */
	public function getMessageTest(): string {
		return (string)($this->getData()["message"] ?? "");
	}

	/**
	 * Метод возвращает ФИО клиента.
	 *
	 * @return string
	 */
	public function getFIO(): string {
		return (string)($this->getData()["fio"] ?? "");
	}

	/**
	 * Метод возвращает имя клиента.
	 *
	 * @return string
	 */
	public function getUserFirstName(): string {
		$fioParts = explode(" ", $this->getFIO());
		return $fioParts[1] ?? "";
	}

	/**
	 * Метод возвращает фамилию клиента.
	 *
	 * @return string
	 */
	public function getUserLastName(): string {
		$fioParts = explode(" ", $this->getFIO());
		return $fioParts[0] ?? "";
	}

	/**
	 * Метод возвращает отчество клиента.
	 *
	 * @return string
	 */
	public function getUserMiddleName(): string {
		$fioParts = explode(" ", $this->getFIO());
		return $fioParts[2] ?? "";
	}

	/**
	 * Метод возвращает логин клиента.
	 *
	 * @return string
	 */
	public function getUserLogin(): string {
		return (string)($this->getData()["user"] ?? "");
	}

	/**
	 * Метод возвращает логин оператора.
	 *
	 * @return string
	 */
	public function getOperatorLogin(): string {
		return (string)($this->getData()["login"] ?? "");
	}

	/**
	 * Метод возвращает время написания сообщения.
	 *
	 * @return DateTimeImmutable|null
	 */
	public function getDate(): ?DateTimeImmutable {
		$dateString = $this->getData()["date"] ?? null;
		if ($dateString === null) return null;

		return DateTimeImmutable::createFromFormat("Y-m-d H:i:s", $dateString) ?: null;
	}

}