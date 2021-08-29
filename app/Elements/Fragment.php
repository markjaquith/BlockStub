<?php

namespace BlockStub\Elements;

use BlockStub\Renderable;
use BlockStub\BlockContract;

class Fragment implements Renderable {
	use Traits\HasChildren;

	public function __construct() {
		$this->bootHasChildren();
	}

	public function renderPhp(BlockContract $block): string {
		return $this->getChildren()->renderPhp($block);
	}

	public function renderReact(): string {
		return sprintf('el(F, null, %s)', $this->getChildren()->renderReact());
	}

	static public function make(): self {
		return new self;
	}
}
