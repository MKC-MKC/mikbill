<?php

namespace Haikiri\MikBiLL\Cabinet\Subscriptions;

use Haikiri\MikBiLL\ResponseWrapper;

class MiddlewareModel extends ResponseWrapper
{

	public function getId(): int
	{
		return $this->getData("id", 0);
	}

	public function getName(): string
	{
		return $this->getData("name", "");
	}

}
