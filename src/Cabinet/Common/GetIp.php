<?php

namespace Haikiri\MikBiLL\Cabinet\Common;

use Haikiri\MikBiLL\ResponseWrapper;

class GetIp extends ResponseWrapper
{

	public function getIp(): string
	{
		return (string)$this->getData("ip");
	}

}
