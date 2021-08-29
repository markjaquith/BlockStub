<?php

namespace BlockStub\Elements;

class Text implements NodeContract {
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
