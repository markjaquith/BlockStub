<?php

namespace BlockStub\Elements;

use BlockStub\Renderable;
use BlockStub\BlockContract;
use BlockStub\Conditions\ConditionContract;

class Condition implements Renderable {
	use Traits\HasChildren;

	protected ConditionContract $condition;

	public function __construct(ConditionContract $condition) {
		$this->condition = $condition;
		$this->bootHasChildren();
	}

	public function renderPhp(BlockContract $block): string {
		return $this->condition->evaluatePhp($block) ? $this->getChildren()->renderPhp($block) : '';
	}

	public function renderReact(): string {
		return sprintf(
			'(%s) && (%s)',
			$this->condition->evaluateReact(),
			$this->getChildren()->renderReact()
		);
	}
}
