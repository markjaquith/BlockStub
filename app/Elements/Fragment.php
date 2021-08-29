<?php

namespace BlockStub\Elements;

use BlockStub\Renderable;

class Fragment implements Renderable {
	use Traits\HasChildren;

	public function __construct() {
		$this->bootHasChildren();
	}

	public function renderPhp(array $attributes): string {
		return $this->getChildren()->renderPhp($attributes);
	}

	public function renderReact(): string {
		return sprintf('el(F, null, %s)', $this->getChildren()->renderReact());
	}

	static public function make(): self {
		return new self;
	}
}
