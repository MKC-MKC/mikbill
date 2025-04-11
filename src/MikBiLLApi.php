<?php

declare(strict_types=1);

namespace Haikiri\MikBiLL;

class MikBiLLApi extends MikBiLLApiAbstract {
	#	Proxy SOCKS:
	public		bool				$isProxy		=	false;	# true - enable proxy ; false - disable proxy ;
	public		int					$proxy_opt		=	CURLOPT_PROXYUSERPWD;
	public		int					$proxy_type		=	CURLPROXY_SOCKS5;
	public		int					$proxy_port		=	8080;
	public		string				$proxy_addr		=	"";
	public		string				$proxy_user		=	"";
	public		string				$proxy_pass		=	"";

	/**
	 * Метод отправки запроса на сервер MikBiLL API.
	 *
	 * @param string $uri
	 * @param string $method
	 * @param array $params
	 * @param bool $sign
	 * @param string|null $token
	 * @return array|null
	 * @throws Exception\InvalidJsonException
	 */
	public function sendRequest($uri, $method = "POST", $params = [], $sign = false, $token = null): ?array {
		$headers = [];

		if ($sign) {
			$params["salt"] = uniqid();
			$params["sign"] = hash_hmac("sha512", $params["salt"], $this->key);
		} else {
			$headers[] = "Authorization: " . $token;
		}

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, rtrim($this->url, "/") . "/" . ltrim($uri, "/"));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
		if (!empty($headers))	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		if ($method == "POST")	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));

		if ($this->isProxy) {
			curl_setopt($ch, CURLOPT_PROXY, $this->proxy_addr);
			curl_setopt($ch, CURLOPT_PROXYPORT, $this->proxy_port);
			curl_setopt($ch, CURLOPT_PROXYTYPE, $this->proxy_type);
			if (!empty($this->proxy_user)) curl_setopt($ch, $this->proxy_opt, $this->proxy_user . ":" . $this->proxy_pass);
		}

		$response	=	curl_exec($ch);
		$statusCode	=	curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

		$validResponse = self::validate($response, true);
		return $statusCode == 200 && is_array($validResponse) ? $validResponse : null;
	}

}