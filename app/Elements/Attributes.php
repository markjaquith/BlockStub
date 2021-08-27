<?php

namespace BlockStub\Elements;

class Attributes {
	const VALUELESS = 'valueless';
	private array $attributes = [];

	public function toArray(): array {
		return $this->attributes;
	}

	public function setAttribute(string $key, $value = self::VALUELESS): self {
		$this->attributes[$key] = $value;

		return $this;
	}
	
	/**
	 * Gets an attribute value.
	 */
	public function getAttribute(string $key): ?string {
		return $this->attributes[$key] ?? null;
	}

	public function renderReact(): string {
		return json_encode($this->toArray() ?: null);
	}

	public function renderHtml(): string {
		$segments = [];

		foreach ($this->attributes as $key => $value) {
			if ($value === self::VALUELESS) {
				$segments[] = $key;
			} else {
				$segments[] = $key . '="' . esc_attr($value) . '"';
			}
		}

		return implode(' ', $segments);
	}
}
