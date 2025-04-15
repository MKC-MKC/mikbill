<?php

namespace Haikiri\MikBiLL\Cabinet\News;

class NewsModel
{

	private array $data;

	public function __construct(array $data)
	{
		$this->data = $data;
	}

	public function getArray(): ?array
	{
		return $this->data ?? [];
	}

	public function getId(): int
	{
		return (int)$this->getArray()["newsid"] ?? 0;
	}

	public function getSubject(): string
	{
		return (string)$this->getArray()["subject"] ?? "";
	}

	public function getText(): string
	{
		return (string)$this->getArray()["text"] ?? "";
	}

}