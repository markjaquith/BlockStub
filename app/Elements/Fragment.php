<?php

namespace BlockStub\Elements;

use BlockStub\BlockContract;

class Fragment extends Node {
	use Traits\HasChildren;

	public function __construct() {
		$this->bootHasChildren();
	}

	public function renderPhp(BlockContract $block): string {
		return $this->getChildren()->renderPhp($block);
	}

	public function renderReact(BlockContract $block): string {
		return sprintf('el(F, null, %s)', $this->getChildren()->renderReact($block));
	}
}
