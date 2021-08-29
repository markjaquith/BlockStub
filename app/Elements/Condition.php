<?php

namespace BlockStub\Elements;

use BlockStub\Renderable;
use BlockStub\Conditions\ConditionContract;

class Condition implements Renderable {
	use Traits\HasChildren;

	protected ConditionContract $condition;

	public function __construct(ConditionContract $condition) {
		$this->condition = $condition;
		$this->bootHasChildren();
	}

	public function renderPhp(array $attributes): string {
		return $this->condition->evaluatePhp($attributes) ? $this->getChildren()->renderPhp($attributes) : '';
	}

	public function renderReact(): string {
		return sprintf(
			'(%s) && (%s)',
			$this->condition->evaluateReact(),
			$this->getChildren()->renderReact()
		);
	}
}
