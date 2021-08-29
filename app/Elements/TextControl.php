<?php

namespace BlockStub\Elements;

use BlockStub\Attribute;
use BlockStub\Renderable;
use BlockStub\BlockContract;

class TextControl implements Renderable {
	protected Attribute $attribute;

	// TODO: Make this take a string.
	public function __construct(Attribute $attribute) {
		$this->attribute = $attribute;
	}

	public function renderPhp(BlockContract $block): string {
		return '';
	}

	public function renderReact(BlockContract $block): string {
		$value = $this->attribute->renderReact();
		$onChange = $this->attribute->renderReactSet();

		return <<<JS
			el(wp.components.TextControl, {
				value: $value,
				onChange: $onChange,
			})
		JS;
	}
}