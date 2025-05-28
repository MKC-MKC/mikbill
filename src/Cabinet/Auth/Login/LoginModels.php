<?php

namespace Haikiri\MikBiLL\Cabinet\Auth\Login;

use Haikiri\MikBiLL\ResponseWrapper;

class LoginModels extends ResponseWrapper
{

	public function getToken(): string
	{
		return (string)$this->getData("token");
	}

}
