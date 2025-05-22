<?php

namespace Haikiri\MikBiLL\Cabinet\Common;

use Haikiri\MikBiLL\ResponseWrapper;

class GetIpModel extends ResponseWrapper
{

	public function getIp(): string
	{
		return $this->getData("ip", "");
	}

}
