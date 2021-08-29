<?php

namespace BlockStub;

interface Renderable {
	public function renderPhp(array $attributes): string;
	public function renderReact(): string;
}
