<?php

namespace BlockStub;

use BlockStub\Elements\NodeContract;

class Attribute implements NodeContract {
	public string $name;
	public string $type;
	public string $default = '';

	public function __construct(string $name, string $type = 'string', $default = '') {
		$this->name = $name;
		$this->type = $type;
		$this->default = $default;
	}

	public function renderPhp(array $attributes = []): string {
		return $attributes[$this->name] ?? $this->default ?? '';
	}

	public function renderReact(): string {
		return sprintf('attributes[%s] || ""', json_encode($this->name));
	}

	public function renderReactSet(): string {
		return sprintf('v => setAttributes({%s: v})', json_encode($this->name));
	}
}