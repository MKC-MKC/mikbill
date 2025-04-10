<?php

namespace Haikiri\MikBiLL\Cabinet\Auth\Login;

class LoginModels implements LoginModelsInterface {
	private		?array				$data;

	public function __construct(?array $data) {
		$this->data = $data;
	}

	public function getToken() : ?string {
		return (string)$this->data["token"] ?? null;
	}
}