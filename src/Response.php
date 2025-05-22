<?php

namespace Haikiri\MikBiLL;

class Response
{

	private function __construct(
		private bool   $success,
		private int    $code,
		private string $message,
		private mixed  $data,
		private mixed  $raw,
	)
	{
	}

	public static function fromResponse(array $response): self
	{
		return new self(
			success: (bool)($response["success"] ?? false),
			code: (int)($response["code"] ?? $response["error"] ?? -1),
			message: (string)($response["message"] ?? $response["errortext"] ?? "N/A"),
			data: is_array($response["data"] ?? null) ? $response["data"] : null,
			raw: $response,
		);
	}

	public function isSuccess(): bool
	{
		return $this->success;
	}

	public function getCode(): int
	{
		return $this->code;
	}

	public function getMessage(): string
	{
		return $this->message;
	}

	public function getRaw(): mixed
	{
		return $this->raw;
	}

	public function getData(): mixed
	{
		return $this->data;
	}

	public function getToken(): string|null
	{
		if (!isset($this->data["token"])) return null;
		return $this->data["token"];
	}

}
