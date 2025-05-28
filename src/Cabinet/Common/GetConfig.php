<?php

namespace Haikiri\MikBiLL\Cabinet\Common;

use Haikiri\MikBiLL\ResponseWrapper;

class GetConfig extends ResponseWrapper
{

	public function getCompanyInfo(): GetCompanyInfo
	{
		return new GetCompanyInfo($this->getData("company_info"));
	}

}
