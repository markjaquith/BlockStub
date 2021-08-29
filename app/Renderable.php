<?php

namespace BlockStub;

interface Renderable {
	public function renderPhp(BlockContract $block): string;
	public function renderReact(BlockContract $block): string;
}
