<?php

namespace Haikiri\MikBiLL\Cabinet;

use Haikiri\MikBiLL\Exception;
use Haikiri\MikBiLL\MikBiLLApiInterface;

class PaymentsController
{
	protected MikBiLLApiInterface $billInterface;

	public function __construct(MikBiLLApiInterface $interface)
	{
		$this->billInterface = $interface;
	}

	/**
	 * Пополнение счета с помощью ваучера.
	 *
	 * @param $series
	 * @param $number
	 * @return bool
	 * @throws Exception\NotEnabled|Exception\BillApiException
	 * @see https://documenter.getpostman.com/view/5969645/TVCfXTtK#9a45c445-0452-4c7f-ac33-329bdd9585ac
	 */
	public function getSessions($series, $number): bool
	{
		$params = [
			"series" => (int)$series,
			"number" => (int)$number,
		];

		$response = $this->billInterface->sendRequest(
			uri: "/api/v1/cabinet/payments/voucher",
			method: "POST",
			params: $params,
			token: $this->billInterface->getUserToken(),
		);

		return $response->isSuccess();
	}

}
