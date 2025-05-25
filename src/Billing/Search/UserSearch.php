<?php

namespace Haikiri\MikBiLL\Billing\Search;

use Haikiri\MikBiLL\Cabinet;
use Haikiri\MikBiLL\ResponseWrapper;

class UserSearch extends ResponseWrapper
{
	/**
	 * Методы доступные в поиске Billing – внутри UserTrait.
	 * @in-search
	 */
	use Cabinet\User\UserTrait;
}
