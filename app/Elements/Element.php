<?php

namespace BlockStub\Elements;

use \BlockStub\Conditions\ConditionContract;

abstract class Element implements NodeContract {
	public string $tag = '';
	public Attributes $attributes;
	public Nodes $children;

	public function __construct(string $text = '') {
		$this->attributes = new Attributes();
		$this->children = new Nodes();

		if ($text) {
			$this->addText($text);
		}
	}

	static public function make(...$args): Element {
		return new static(...$args);
	}

	private function wrapPhp(string $content): string {
		$attributes = $this->attributes->renderHtml();
		$attributes = $attributes ? ' ' . $attributes : '';

		return "<{$this->tag}{$attributes}>{$content}</{$this->tag}>";
	}

	private function wrapReact(string $content): string {
		$attributes = $this->attributes->renderReact();

		return "el('$this->tag', $attributes, $content)";
	}

	public function renderPhp(): string {
		return $this->wrapPhp(
			$this->children->renderPhp()
		);
	}

	public function renderReact(): string {
		return $this->wrapReact(
			$this->children->renderReact()
		);
	}

	public function setAttribute(string $name, $value = null): self {
		$this->attributes->set($name, $value);

		return $this;
	}

	public function addChild(NodeContract $node): NodeContract {
		$this->children->add($node);

		return $this;
	}

	public function addText(string $text): self {
		$this->children->add(new Text($text));

		return $this;
	}

	public function if(ConditionContract $condition): NodeContract {
		$conditionElement = new Condition($condition);
		$this->addChild($conditionElement);

		return $conditionElement;
	}
}
