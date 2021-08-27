<?php

namespace BlockStub;

class Block implements BlockContract {
	protected string $handle;
	protected string $name;
	protected array $attributes;

	public function __construct(string $handle, string $name, array $attributes = []) {
		$this->handle = $handle;
		$this->name = $name;
		$this->attributes = $attributes;
	}

	public function renderJs(): array {
		return ['p', '"Extend renderJs()"'];
	}

	public function renderPhp(): string {
		return "<p>Extend renderPhp()</p>";
	}

	public function getHandle(): string {
		return $this->handle;
	}

	public function getName(): string {
		return $this->name;
	}

	public function getAttributes(): array {
		return $this->attributes;
	}
}