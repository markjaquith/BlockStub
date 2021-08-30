<?php

namespace BlockStub\Elements;

use BlockStub\HtmlNode;
use BlockStub\BlockContract;
use BlockStub\RenderableHtml;

class Element extends HtmlNode {
	use Traits\HasChildren;

	protected string $tag = '';
	protected HtmlAttributes $attributes;
	protected ?string $editableAttribute = null;
	protected bool $selfClosing = false;

	public function __construct($input = null) {
		$this->attributes = new HtmlAttributes();
		$this->bootHasChildren();

		$this->add($input);
	}

	public static function makeTag(string $tag): RenderableHtml {
		return (new self)->setTag($tag);
	}

	public function getTag(): string {
		return $this->tag;
	}

	public function setTag(string $tag): self {
		$this->tag = $tag;

		return $this;
	}

	static public function makeEditable(string $attribute): Element {
		return (new static)->editWith($attribute);
	}

	public function editWith(string $attribute): Element {
		$this->editableAttribute = $attribute;

		return $this;
	}

	private function wrapPhp(string $content, BlockContract $block): string {
		$attributes = $this->attributes->renderPhp($block);
		$attributes = $attributes ? ' ' . $attributes : '';

		if ($this->selfClosing) {
			return "<{$this->tag}{$attributes} />";
		}

		return "<{$this->tag}{$attributes}>{$content}</{$this->tag}>";
	}

	private function wrapReact(string $content, BlockContract $block): string {
		$attributes = $this->attributes->renderReact($block);

		if ($this->editableAttribute) {
			$attribute = $block->getAttribute($this->editableAttribute);
			return sprintf('el(wp.blockEditor.RichText, {
				tagName: %s,
				onChange: %s,
				value: %s,
				__unstableDisableFormats: true,
				preserveWhiteSpace: true,
				disableLineBreaks: true,
			})', json_encode($this->tag), $attribute->renderReactSet(), $attribute->renderReact($block));
		}

		return sprintf('el(%s, %s, %s)', json_encode($this->tag), $attributes, $content);
	}

	public function renderPhp(BlockContract $block): string {
		if ($this->editableAttribute) {
			return $this->wrapPhp(
				$block->getAttribute($this->editableAttribute)->get(),
				$block
			);
		}

		return $this->wrapPhp(
			$this->getChildren()->renderPhp($block),
			$block
		);
	}

	public function renderReact(BlockContract $block): string {
		return $this->wrapReact(
			$this->getChildren()->renderReact($block),
			$block
		);
	}

	public function getAttributes(): HtmlAttributes {
		return $this->attributes;
	}
}
