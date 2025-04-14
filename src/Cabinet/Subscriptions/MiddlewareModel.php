<?php

namespace Haikiri\MikBiLL\Cabinet\Subscriptions;

class MiddlewareModel {
	private array $data;

	public function __construct(array $data) {
		$this->data = $data;
	}

	public function getId(): int {
		return (int)$this->data["id"] ?? 0;
	}

	public function getName(): string {
		return (string)$this->data["name"] ?? "";
	}

}