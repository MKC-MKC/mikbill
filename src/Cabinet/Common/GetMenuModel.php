<?php

namespace Haikiri\MikBiLL\Cabinet\Common;

class GetMenuModel
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
		return (int)$this->getData()["id"] ?? 0;
	}

	public function getName(): string
	{
		return (string)$this->getData()["name"] ?? "";
	}

	public function getUri(): string
	{
		return (string)$this->getData()["link"] ?? "";
	}

	public function getUserGroupId(): int
	{
		return (int)$this->getData()["usersgroupid"] ?? 0;
	}

	public function getParent(): int
	{
		return (int)$this->getData()["parent"] ?? 0;
	}

	public function getSort(): int
	{
		return (int)$this->getData()["sort"] ?? 0;
	}

	public function getHide(): int
	{
		return (int)$this->getData()["hide"] ?? 0;
	}

	public function getIcon(): string
	{
		return (string)$this->getData()["icon"] ?? "";
	}

	public function getHook(): string
	{
		return (string)$this->getData()["hook"] ?? "";
	}

	public function getTitle(): string
	{
		return (string)$this->getData()["title"] ?? "";
	}

	public function getDescription(): string
	{
		return (string)$this->getData()["description"] ?? "";
	}

	public function getKeywords(): string
	{
		return (string)$this->getData()["keywords"] ?? "";
	}

}
