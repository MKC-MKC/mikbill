<?php

namespace Haikiri\MikBiLL\Cabinet;

use DateTime;
use Haikiri\MikBiLL\MikBiLLApiInterface;
use Haikiri\MikBiLL\Exception\BillApiException;

class ReportsController
{

	protected MikBiLLApiInterface $billInterface;

	public function __construct(MikBiLLApiInterface $interface)
	{
		$this->billInterface = $interface;
	}

	/**
	 * История платежей за указанный период.
	 *
	 * @param int|string $limit
	 * @param int|string|null $offset
	 * @param string|null $order
	 * @param DateTime|null $from
	 * @param DateTime|null $to
	 * @return Reports\PaymentItems
	 * @throws BillApiException
	 * @see https://documenter.getpostman.com/view/5969645/TVCfXTtK#0c1b52f5-96c2-4e8e-adf8-11f534108bd3
	 */
	public function getPayments(
		int|string      $limit = 10,
		int|string|null $offset = null,
		string|null     $order = "DESC",
		DateTime|null   $from = null,
		DateTime|null   $to = null,
	): object
	{
		$params = [
			"offset" => $offset,
			"limit" => $limit,
			"sort" => $order,
			"from_date" => $from?->format("Y-m-d"),
			"to_date" => $to?->format("Y-m-d"),
		];

		$response = $this->billInterface->sendRequest(
			uri: "/api/v1/cabinet/report/payments",
			method: "POST",
			params: $params,
			token: $this->billInterface->getUserToken(),
		);

		return new Reports\PaymentItems($response->getData());
	}

	/**
	 * История сессий за указанный период.
	 *
	 * @param int|string $limit
	 * @param int|string|null $offset
	 * @param string|null $order
	 * @param DateTime|null $from
	 * @param DateTime|null $to
	 * @return Reports\Session
	 * @throws BillApiException
	 * @see https://documenter.getpostman.com/view/5969645/TVCfXTtK#21e400a3-ae46-4ac1-8bb1-66121e483873
	 */
	public function getSessions(
		int|string      $limit = 10,
		int|string|null $offset = null,
		string|null     $order = "DESC",
		DateTime|null   $from = null,
		DateTime|null   $to = null,
	): object
	{
		$params = [
			"offset" => $offset,
			"limit" => $limit,
			"sort" => $order,
			"from_date" => $from?->format("Y-m-d"),
			"to_date" => $to?->format("Y-m-d"),
		];

		$response = $this->billInterface->sendRequest(
			uri: "/api/v1/cabinet/report/sessions",
			method: "POST",
			params: $params,
			token: $this->billInterface->getUserToken(),
		);

		return new Reports\SessionItems($response->getData());
	}

}
