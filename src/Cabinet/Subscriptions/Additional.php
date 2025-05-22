<?php

namespace Haikiri\MikBiLL\Cabinet\Subscriptions;

use Haikiri\MikBiLL\ResponseWrapper;

class Additional extends ResponseWrapper
{

	/**
	 * @deprecated Используй getData();
	 * @return array|null
	 */
	public function getAsIs(): array|null
	{
		return $this->getAsArray();
	}

}
