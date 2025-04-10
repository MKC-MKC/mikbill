<?php

namespace Haikiri\MikBiLL;

interface MikBiLLApiInterface {
	public function setUserToken(?string $token): void;
	public function getUserToken(): ?string;
	public function sendRequest(string $uri, string $method = "POST", array $params = [], bool $sign = false, ?string $token = null): ?array;
	public static function validate(string $json, ?bool $asArray, int $depth, int $flags);
}