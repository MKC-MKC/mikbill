<?php

declare(strict_types=1);

namespace Haikiri\MikBiLL\Tests\Trait;

trait CabinetUserFeeTraitTest
{

	public function test_getUserFeeTotal($expected = 4030): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserFeeTotal());
	}

	public function test_getUserFeePacketPrice($expected = 4030): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserFeePacketPrice());
	}

	public function test_getUserFeeSubscriptionsTotal($expected = 0): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserFeeSubscriptionsTotal());
	}

	public function test_getUserFeeDevicesTotal($expected = 0): void
	{
		$data = self::$MikBiLL->cabinet->User()->getUser();
		$this->assertSame($expected, $data->getUserFeeDevicesTotal());
	}

}
