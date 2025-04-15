<?php

namespace Haikiri\MikBiLL\Cabinet\Common;

class GetIpModel
{

	private array $data;

	public function __construct(array $data)
	{
		$this->data = $data;
	}

	public function getArray(): ?array
	{
		return $this->data ?? [];
	}

	public function getIp(): string
	{
		return (string)$this->getArray()["ip"] ?? "";
	}

}
