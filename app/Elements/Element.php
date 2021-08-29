<?php

namespace BlockStub\Elements;

use BlockStub\Attribute;
use BlockStub\Renderable;
use BlockStub\BlockContract;

abstract class Element implements Renderable {
	use Traits\HasChildren;

	public string $tag = '';
	protected HtmlAttributes $attributes;
	protected ?Attribute $editableAttribute = null;

	public function __construct($input = null) {
		$this->attributes = new HtmlAttributes();
		$this->bootHasChildren();

		$this->add($input);
	}

	static public function make(...$args): Element {
		return new static(...$args);
	}

	static public function makeEditable(Attribute $attribute): Element {
		return (new static)->editWith($attribute);
	}

	public function editWith(Attribute $attribute): Element {
		$this->editableAttribute = $attribute;
		$this->add($attribute);

		return $this;
	}

	private function wrapPhp(string $content, BlockContract $block): string {
		$attributes = $this->attributes->renderPhp($block);
		$attributes = $attributes ? ' ' . $attributes : '';

		return "<{$this->tag}{$attributes}>{$content}</{$this->tag}>";
	}

	private function wrapReact(string $content): string {
		$attributes = $this->attributes->renderReact();

		if ($this->editableAttribute) {
			return sprintf('el(wp.blockEditor.RichText, {
				tagName: %s,
				onChange: %s,
				value: %s,
				__unstableDisableFormats: true,
				preserveWhiteSpace: true,
				disableLineBreaks: true,
			})', json_encode($this->tag), $this->editableAttribute->renderReactSet(), $this->editableAttribute->renderReact());
		}

		return sprintf('el(%s, %s, %s)', json_encode($this->tag), $attributes, $content);
	}

	public function renderPhp(BlockContract $block): string {
		return $this->wrapPhp(
			$this->getChildren()->renderPhp($block),
			$block
		);
	}

	public function renderReact(): string {
		return $this->wrapReact(
			$this->getChildren()->renderReact()
		);
	}

	public function setAttribute(string $name, $value = null): self {
		$this->attributes->set($name, $value);

		return $this;
	}

	public function getAttributes(): HtmlAttributes {
		return $this->attributes;
	}
}
