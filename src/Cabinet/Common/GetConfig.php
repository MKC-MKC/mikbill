<?php

namespace Haikiri\MikBiLL\Cabinet\Common;

class GetConfig
{

	private array $data;

	public function __construct(array $data)
	{
		$this->data = $data;
	}

	public function getAsArray(): ?array
	{
		return $this->data ?? [];
	}

	public function getCompanyInfo(): GetCompanyInfo
	{
		return new GetCompanyInfo($this->getAsArray()["company_info"] ?? []);
	}

}
