<?php

namespace BlockStub\Elements\Traits;

use BlockStub\Elements\{Nodes, Condition, Text};
use BlockStub\Renderable;
use BlockStub\Conditions\ConditionContract;

trait HasChildren {
	protected Nodes $children;

	public function bootHasChildren() {
		$this->children = new Nodes();
	}

	public function add($node): Renderable {
		if ($node instanceof Renderable) {
			$this->children->add($node);
		} elseif (is_string($node)) {
			$this->addText($node);
		} elseif (is_array($node)) {
			foreach ($node as $_node) {
				$this->add($_node);
			}
		} elseif (is_null($node)) {
			// Do nothing.
		} else {
			var_dump($node);
			throw new \Exception('::add() can only accept Renderable, string, Renderable[], or string[]');
		}

		return $this;
	}

	public function getChildren(): Nodes {
		return $this->children;
	}

	public function addText(string $text): self {
		$this->children->add(new Text($text));

		return $this;
	}

	public function if(ConditionContract $condition): Renderable {
		$conditionElement = new Condition($condition);
		$this->add($conditionElement);

		return $conditionElement;
	}
}