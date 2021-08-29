<?php

namespace BlockStub\Elements;

use BlockStub\Renderable;

class Text implements Renderable {
	public function __construct($text) {
		$this->text = $text;
	}

	public function renderPhp(array $attributes): string {
		return $this->text;
	}

	public function renderReact(): string {
		return json_encode($this->text);
	}
}
