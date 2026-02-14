<?php

declare(strict_types=1);

namespace Tests\Haikiri\MikBiLL;

use PHPUnit\Framework\TestCase;
use Tests\Haikiri\MikBiLL\Mock\CreateApi;

final class SubscriptionsTest extends TestCase
{
	use CreateApi;

	protected static string $signKey = "not-expected";
	protected static ?string $token = "Bearer eyJ0eXAiOi.JKV1QiLCJ.hbGciOiJIUzI.1NiJ9";

	public function testGetSubscriptionsReturnsExpectedCount(): void
	{
		$MikBiLL = self::fromFile(__DIR__ . "/Responses/valid/Cabinet/subscriptions/other.get.json");
		$subscriptions = $MikBiLL->cabinet->Subscriptions()->getSubscriptions(service: "other");
		self::assertCount(4, $subscriptions);
	}

	public function testSetSubscriptionReturnsSuccess(): void
	{
		$MikBiLL = self::fromFile(__DIR__ . "/Responses/valid/Cabinet/subscriptions/other.post.json");
		$status = $MikBiLL->cabinet->Subscriptions()->setSubscription(id: "100", activate: 1, service: "other");
		self::assertTrue($status);
	}

	public function testGetMiddlewaresReturnsExpectedCount(): void
	{
		$MikBiLL = self::fromFile(__DIR__ . "/Responses/valid/Cabinet/subscriptions/middlewares.get.json");
		$mws = $MikBiLL->cabinet->Subscriptions()->getMiddlewares()->getMiddlewares();
		self::assertCount(6, $mws);
	}

}
