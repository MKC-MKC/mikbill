<?php

namespace Haikiri\MikBiLL\Cabinet\Auth\Phone;

class PhoneOtpModels {
	private		?array				$data;

	public function __construct(?array $data) {
		$this->data = $data;
	}

	/**
	 * Метод возвращает результат как массив.
	 *
	 * @return array|null
	 */
	public function getAsArray(): ?array {
		return $this->data;
	}

	/**
	 * Метод возвращает UID клиента.
	 *
	 * @return int
	 */
	public function getUserId(): int {
		return (int)$this->data["uid"] ?? 0;
	}

	/**
	 * Метод возвращает токен клиента.
	 *
	 * @return string|null
	 */
	public function getUserToken(): ?string {
		return (string)$this->data["token"] ?? "";
	}

}