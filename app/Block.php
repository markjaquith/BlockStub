<?php

namespace BlockStub;

class Block implements BlockContract {
	protected string $handle;
	protected string $title;
	protected array $attributes;

	public function __construct(string $handle, string $title, array $attributes = []) {
		$this->handle = $handle;
		$this->title = $title;
		$this->attributes = $attributes;
	}

	public function render(): Elements\NodeContract {
		return (new Elements\P)->addText('Extend the render() method');
	}

	public function getHandle(): string {
		return $this->handle;
	}

	public function getTitle(): string {
		return $this->title;
	}

	public function getAttributes(): array {
		return $this->attributes;
	}
}