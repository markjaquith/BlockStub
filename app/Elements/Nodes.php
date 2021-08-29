<?php

namespace BlockStub\Elements;

class Nodes {
	private array $nodes = [];

	public function add(NodeContract $node): NodeContract {
		$this->nodes[] = $node;

		return $node;
	}

	public function toArray(): array {
		return $this->nodes;
	}

	public function renderPhp(array $attributes): string {
		return implode('', array_map(fn ($node) => $node->renderPhp($attributes), $this->nodes));
	}

	public function renderReact(): string {
		return '[' . implode(',', array_map(fn ($node) => $node->renderReact(), $this->nodes)) . ']';
	}
}