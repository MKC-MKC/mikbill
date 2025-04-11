<?php

namespace Haikiri\MikBiLL;

interface MikBiLLApiInterface {
	public function setUserToken(?string $token): void;
	public function getUserToken(): ?string;
	public function sendRequest($uri, $method, $params, $sign, $token);
	public static function validate(string $json, ?bool $asArray, int $depth, int $flags);
}