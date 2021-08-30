<?php

namespace BlockStub;
abstract class HtmlNode extends Node implements RenderableHtml {
	static public function make(...$args): RenderableHtml {
		return new static(...$args);
	}
}