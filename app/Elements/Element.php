<?php

namespace BlockStub\Elements;

use \BlockStub\Conditions\ConditionContract;

abstract class Element implements NodeContract {
	use Traits\HasChildren;

	public string $tag = '';
	public Attributes $attributes;

	public function __construct(string $text = '') {
		$this->attributes = new Attributes();
		$this->bootHasChildren();

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
}
