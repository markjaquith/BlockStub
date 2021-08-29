<?php

namespace BlockStub;

use BlockStub\Elements\HtmlAttributes;

interface RenderableHtml extends Renderable {
	public function getTag(): string;
	public function getAttributes(): HtmlAttributes;
	public function getChildren(): Elements\Nodes;
}
