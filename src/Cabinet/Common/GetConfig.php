<?php

namespace Haikiri\MikBiLL\Cabinet\Common;

use Haikiri\MikBiLL\ResponseWrapper;

class GetConfig extends ResponseWrapper
{

	public function getCompanyInfo(): GetCompanyInfoModel
	{
		return new GetCompanyInfoModel($this->getData("company_info"));
	}

}
