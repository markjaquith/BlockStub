<?php

namespace BlockStub;

use BlockStub\Elements\NodeContract;
use BlockStub\Elements\Element;

class Wrap implements NodeContract {
	protected Element $element;

	public function __construct(Element $element) {
		$this->element = $element;
	}

	public function renderPhp(array $attributes): string {
		return $this->element->renderPhp($attributes);
	}

	public function renderReact(): string {
		return sprintf(
			'el(%s, wp.blockEditor.useBlockProps(%s || {}), %s)',
			json_encode($this->element->tag),
			$this->element->getAttributes()->renderReact(),
			$this->element->getChildren()->renderReact()
		);
	}
}