<?php

declare(strict_types=1);

namespace Haikiri\MikBiLL;

use Haikiri\MikBiLL\Billing as MikBiLLBilling;

class Billing implements BillingInterface
{

	protected MikBiLLApiInterface $billInterface;

	public function __construct(MikBiLLApiInterface $interface)
	{
		$this->billInterface = $interface;
	}

	public function Users(): object
	{
		return new MikBiLLBilling\UsersController(interface: $this->billInterface);
	}

}