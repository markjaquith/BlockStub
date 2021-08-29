<?php

namespace BlockStub;

class BlockAttributes {
	private array $attributes = [];

	public function add(Attribute $attribute) {
		 $this->attributes[$attribute->name] = $attribute;
	}

	public function get(string $attributeName): ?Attribute {
		return $this->attributes[$attributeName] ?? null;
	}

	public function all(): array {
		return $this->attributes;
	}
}
