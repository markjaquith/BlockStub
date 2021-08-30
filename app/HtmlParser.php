<?php

namespace BlockStub;

use BlockStub\Elements\{Text, Element};

class HtmlParser {
	private string $html;
	private BlockContract $block;

	public function __construct(string $html, BlockContract $block) {
		$this->html = $html;
		$this->block = $block;
	}

	public function renderNode(\DOMNode $node): Renderable {
		switch ($node->nodeType) {

			case \XML_ELEMENT_NODE:
				if ($node->tagName === 'el') {
					$elementClass = $node->attributes->getNamedItem('class');
					if ($elementClass && class_exists($elementClass->value)) {
						return new $elementClass->value;
					} else {
						return P::make('<el /> needs a callable class');
					}
				} else {
					$xBind = $node->attributes->getNamedItem('x-bind');
					$xText = $node->attributes->getNamedItem('x-text');
					$el = Element::makeTag($node->nodeName)
						->setAttributes($node->hasAttributes() ? $this->collectAttributes($node->attributes) : [])
						->add($node->hasChildNodes() ? $this->renderNodes($node->childNodes) : null)
						->editWith($xBind ? $xBind->value : null);

					if ($xText) {
						$el->add($this->block->getAttribute($xText->value));
					}

					return $el;
				}

			case \XML_TEXT_NODE:
				return Text::make($node->textContent);

			default:
				var_dump($node);
				die;
		}
	}

	public function collectAttributes(\DOMNamedNodeMap $attributes): array {
		$out = [];
		$omit = [
			'x-bind' => true,
			'x-text' => true,
		];

		foreach ($attributes as $attribute) {
			if ($omit[$attribute->name] ?? false) {
				continue;
			}

			$out[$attribute->name] = $attribute->value;
		}

		return $out;
	}

	public function renderNodes(\DOMNodeList $nodes): array {
		$out = [];

		foreach ($nodes as $node) {
			$out[] = $this->renderNode($node);
		}

		return $out;
	}

	public function render(): Renderable {
		$html = new \DOMDocument();
		\libxml_use_internal_errors(true);
		$html->loadHTML($this->html);
		$rootEl = $html->getElementsByTagName('body')->item(0)->firstChild;


		return $this->renderNode($rootEl);
	}
}