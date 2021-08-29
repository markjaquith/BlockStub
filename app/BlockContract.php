<?php

namespace BlockStub;

interface BlockContract {
	public function render(): Elements\NodeContract;
	public function getHandle(): string;
	public function getTitle(): string;
	public function getAttributes(): array;
	public function getAttribute(string $name): ?Attribute;
}