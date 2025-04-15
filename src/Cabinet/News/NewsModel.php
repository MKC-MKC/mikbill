<?php

namespace Haikiri\MikBiLL\Cabinet\News;

class NewsModel
{

	private array $data;

	public function __construct(array $data)
	{
		$this->data = $data;
	}

	public function getData(): ?array
	{
		return $this->data ?? [];
	}

	public function getId(): int
	{
		return (int)$this->getData()["newsid"] ?? 0;
	}

	public function getSubject(): string
	{
		return (string)$this->getData()["subject"] ?? "";
	}

	public function getText(): string
	{
		return (string)$this->getData()["text"] ?? "";
	}

}