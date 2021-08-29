<?php

namespace BlockStub\Elements;

use BlockStub\Attribute;

class TextControl implements NodeContract {
	protected Attribute $attribute;

	public function __construct(Attribute $attribute) {
		$this->attribute = $attribute;
	}

	public function renderPhp(array $attributes): string {
		return '';
	}

	public function renderReact(): string {
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