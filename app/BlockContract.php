<?php

namespace BlockStub;

interface BlockContract {
	public function render(): RenderableHtml;
	public function getHandle(): string;
	public function getTitle(): string;
	public function getAttributes(): array;
	public function getAttribute(string $name): ?Attribute;
	public function setAttributes(array $attributes): BlockContract;
	public function getIcon(): string;
}