<?php

namespace Haikiri\MikBiLL;

interface MikBiLLApiInterface
{
	public function getUserToken();

	public function setUserToken($token);

	public static function validate(string $json, ?bool $asArray, int $depth, int $flags);

}
