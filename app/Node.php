<?php

namespace BlockStub;
class Node implements Renderable {
	public function renderReact(BlockContract $block): string {
		return 'Implement renderReact() in ' . self::class;
	}

	public function renderPhp(BlockContract $block): string {
		return 'Implement renderPhp() in ' . self::class;
	}

	static public function make(...$args): Renderable {
		return new static(...$args);
	}
}