<?php

namespace BlockStub\Elements;

use BlockStub\Conditions\ConditionContract;

class Condition implements NodeContract {
	protected ConditionContract $condition;
	protected Nodes $children;

	public function __construct(ConditionContract $condition) {
		$this->condition = $condition;
		$this->children = new Nodes();
	}

	public function renderPhp(): string {
		return $this->condition->evaluatePhp() ? $this->children->renderPhp() : '';
	}

	public function renderReact(): string {
		return sprintf(
			'(%s) && (%s)',
			$this->condition->evaluateReact(),
			$this->children->renderReact()
		);
	}

	public function addChild(NodeContract $node): self {
		$this->children->add($node);

		return $this;
	}

	public function addText(string $text): self {
		$this->children->add(new Text($text));

		return $this;
	}
}
