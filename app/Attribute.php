<?php

namespace BlockStub;

class Attribute implements Renderable {
	public string $name;
	public string $type;
	public string $default = '';
	public $value;

	public function __construct(string $name, string $type = 'string', $default = '') {
		$this->name = $name;
		$this->type = $type;
		$this->default = $default;
	}

	public function renderPhp(BlockContract $block): string {
		return $this->get();
	}

	public function renderReact(): string {
		return sprintf('attributes[%s] || ""', json_encode($this->name));
	}

	public function renderReactSet(): string {
		return sprintf('v => setAttributes({%s: v})', json_encode($this->name));
	}

	public function get() {
		return $this->value ?? $this->default;
	}

	public function set($value) {
		$this->value = $value;
	}
}