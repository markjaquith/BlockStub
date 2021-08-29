<?php

namespace BlockStub\Elements;

use BlockStub\Renderable;
use BlockStub\BlockContract;

class Nodes {
	private array $nodes = [];

	public function add(Renderable $node): Renderable {
		$this->nodes[] = $node;

		return $node;
	}

	public function toArray(): array {
		return $this->nodes;
	}

	public function renderPhp(BlockContract $block): string {
		return implode('', array_map(fn ($node) => $node->renderPhp($block), $this->nodes));
	}

	public function renderReact(): string {
		return '[' . implode(',', array_map(fn ($node) => $node->renderReact(), $this->nodes)) . ']';
	}
}