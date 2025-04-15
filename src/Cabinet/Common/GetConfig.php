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

	public function getCompanyInfo(): GetCompanyInfoModel
	{
		return new GetCompanyInfoModel($this->getAsArray()["company_info"] ?? []);
	}

}
