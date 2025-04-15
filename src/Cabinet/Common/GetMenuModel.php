<?php

namespace Haikiri\MikBiLL\Cabinet\Common;

class GetMenuModel
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
		return (int)$this->getArray()["id"] ?? 0;
	}

	public function getName(): string
	{
		return (string)$this->getArray()["name"] ?? "";
	}

	public function getUri(): string
	{
		return (string)$this->getArray()["link"] ?? "";
	}

	public function getUserGroupId(): int
	{
		return (int)$this->getArray()["usersgroupid"] ?? 0;
	}

	public function getParent(): int
	{
		return (int)$this->getArray()["parent"] ?? 0;
	}

	public function getSort(): int
	{
		return (int)$this->getArray()["sort"] ?? 0;
	}

	public function getHide(): int
	{
		return (int)$this->getArray()["hide"] ?? 0;
	}

	public function getIcon(): string
	{
		return (string)$this->getArray()["icon"] ?? "";
	}

	public function getHook(): string
	{
		return (string)$this->getArray()["hook"] ?? "";
	}

	public function getTitle(): string
	{
		return (string)$this->getArray()["title"] ?? "";
	}

	public function getDescription(): string
	{
		return (string)$this->getArray()["description"] ?? "";
	}

	public function getKeywords(): string
	{
		return (string)$this->getArray()["keywords"] ?? "";
	}

}
