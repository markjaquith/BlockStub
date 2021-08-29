<?php

namespace BlockStub\Elements\Traits;

use BlockStub\Elements\{Nodes, NodeContract, Condition, Text};
use BlockStub\Conditions\ConditionContract;

trait HasChildren {
	public Nodes $children;

	public function bootHasChildren() {
		$this->children = new Nodes();
	}

	public function add($node): NodeContract {
		if ($node instanceof NodeContract) {
			$this->children->add($node);
		} elseif (is_string($node)) {
			$this->addText($node);
		} elseif (is_array($node)) {
			foreach ($node as $_node) {
				$this->add($_node);
			}
		} else {
			var_dump($node);
			throw new \Exception('::add() can only accept NodeContract, string, NodeContract[], or string[]');
		}

		return $this;
	}

	public function addText(string $text): self {
		$this->children->add(new Text($text));

		return $this;
	}

	public function if(ConditionContract $condition): NodeContract {
		$conditionElement = new Condition($condition);
		$this->add($conditionElement);

		return $conditionElement;
	}
}