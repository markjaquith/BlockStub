<?php

namespace BlockStub;

abstract class Block implements BlockContract {
	protected string $handle;
	protected string $title;
	protected string $icon = 'plugins-checked';
	protected BlockAttributes $blockAttributes;
	protected array $attributes = [];

	public function __construct() {
		if (!isset($this->handle)) {
			wp_die('Block ' . static::class . ' must provide a $handle');
		} elseif (!isset($this->title)) {
			wp_die('Block ' . static::class . ' must provide a $title');
		}

		$this->blockAttributes = new BlockAttributes();

		foreach ($this->attributes as $key => $data) {
			$this->blockAttributes->add(
				new Attribute($key, $data['type'] ?? null, $data['default'] ?? null)
			);
		}
	}

	public function render(): RenderableHtml {
		return (new Elements\P)->addText('Extend the render() method');
	}

	public function renderHtml(string $html): RenderableHtml {
		return (new HtmlParser($html, $this))->render();
	}

	public function getIcon(): string {
		return $this->icon;
	}

	public function getHandle(): string {
		return $this->handle;
	}

	public function getTitle(): string {
		return $this->title;
	}

	public function getAttributes(): array {
		return $this->blockAttributes->all();
	}

	public function getAttribute(string $name): Attribute {
		return $this->blockAttributes->get($name);
	}

	public function setAttributes(array $attributes): BlockContract {
		foreach ($attributes as $key => $value) {
			$attribute = $this->getAttribute($key);
			if ($attribute) {
				$attribute->set($value);
			}
		}

		return $this;
	}
}