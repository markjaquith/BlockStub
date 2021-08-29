<?php

namespace BlockStub\Elements;

use BlockStub\Renderable;
use BlockStub\BlockContract;

class HtmlAttributes implements Renderable {
	const VALUELESS = 'valueless';
	private array $attributes = [];

	public function toArray(): array {
		return $this->attributes;
	}

	public function setAttribute(string $key, $value = self::VALUELESS): self {
		$this->attributes[$key] = $value;

		return $this;
	}

	public function getAttribute(string $key): ?string {
		return $this->attributes[$key] ?? null;
	}

	public function renderReact(BlockContract $block): string {
		return json_encode($this->mapHtmlAttributesToJavaScript($this->toArray()) ?: null);
	}

	public function mapHtmlAttributesToJavaScript(array $attributes): array {
		return array_combine(
			array_map([$this, 'mapHtmlAttributeToJavaScript'], array_keys($attributes)),
			array_values($attributes)
		);
	}

	public function mapHtmlAttributeToJavaScript(string $attribute): string {
		$map = [
			'acceptcharset' => 'acceptCharset',
			'accesskey' => 'accessKey',
			'bgcolor' => 'bgColor',
			'cellindex' => 'cellIndex',
			'cellpadding' => 'cellPadding',
			'cellspacing' => 'cellSpacing',
			'choff' => 'chOff',
			'class' => 'className',
			'codebase' => 'codeBase',
			'codetype' => 'codeType',
			'colspan' => 'colSpan',
			'datetime' => 'dateTime',
			'checked' => 'defaultChecked',
			'selected' => 'defaultSelected',
			'value' => 'defaultValue',
			'frameborder' => 'frameBorder',
			'httpequiv' => 'httpEquiv',
			'longdesc' => 'longDesc',
			'marginheight' => 'marginHeight',
			'marginwidth' => 'marginWidth',
			'maxlength' => 'maxLength',
			'nohref' => 'noHref',
			'noresize' => 'noResize',
			'noshade' => 'noShade',
			'nowrap' => 'noWrap',
			'readonly' => 'readOnly',
			'rowindex' => 'rowIndex',
			'rowspan' => 'rowSpan',
			'sectionrowindex' => 'sectionRowIndex',
			'selectedindex' => 'selectedIndex',
			'tabindex' => 'tabIndex',
			'tbodies' => 'tBodies',
			'tfoot' => 'tFoot',
			'thead' => 'tHead',
			'url' => 'URL',
			'usemap' => 'useMap',
			'valign' => 'vAlign',
			'valuetype' => 'valueType',
		];

		$attribute = strtolower($attribute);

		return $map[$attribute] ?? $attribute;
	}

	public function renderPhp(BlockContract $block): string {
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
