<?php

namespace BlockStub;

use BlockStub\Elements\Element;

class Wrap implements Renderable {
	protected Element $element;

	public function __construct(Element $element) {
		$this->element = $element;
	}

	public function renderPhp(BlockContract $block): string {
		return $this->element->renderPhp($block);
	}

	public function renderReact(BlockContract $block): string {
		return sprintf(
			'el(%s, wp.blockEditor.useBlockProps(%s || {}), %s)',
			json_encode($this->element->tag),
			$this->element->getAttributes()->renderReact($block),
			$this->element->getChildren()->renderReact($block)
		);
	}
}