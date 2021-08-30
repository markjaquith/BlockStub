<?php

namespace BlockStub;

use BlockStub\Elements\Nodes;
use BlockStub\Elements\HtmlAttributes;

class Wrap implements RenderableHtml {
	protected RenderableHtml $element;

	public function __construct(RenderableHtml $element) {
		$this->element = $element;
	}

	public function getTag(): string {
		return $this->element->getTag();
}

	public function renderPhp(BlockContract $block): string {
		return $this->element->renderPhp($block);
	}

	public function renderReact(BlockContract $block): string {
		return sprintf(
			'el(%s, wp.blockEditor.useBlockProps(%s || {}), %s)',
			json_encode($this->element->getTag()),
			$this->element->getAttributes()->renderReact($block),
			$this->element->getChildren()->renderReact($block)
		);
	}

	public function getChildren(): Nodes {
		return $this->element->getChildren();
	}

	public function getAttributes(): HtmlAttributes {
		return $this->element->getAttributes();
	}
}