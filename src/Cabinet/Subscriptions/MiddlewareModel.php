<?php

namespace Haikiri\MikBiLL\Cabinet\Subscriptions;

use Haikiri\MikBiLL\ResponseWrapper;

class MiddlewareModel extends ResponseWrapper
{

	public function getId(): int
	{
		return (int)$this->getData("id");
	}

	public function getName(): string
	{
		return (string)$this->getData("name");
	}

}
