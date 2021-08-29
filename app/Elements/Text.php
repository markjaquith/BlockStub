<?php

namespace BlockStub\Elements;

use BlockStub\Renderable;
use BlockStub\BlockContract;

class Text implements Renderable {
	public function __construct($text) {
		$this->text = $text;
	}

	public function renderPhp(BlockContract $block): string {
		return $this->text;
	}

	public function renderReact(): string {
		return json_encode($this->text);
	}
}
