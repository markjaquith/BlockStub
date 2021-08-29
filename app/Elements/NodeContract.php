<?php

namespace BlockStub\Elements;

interface NodeContract {
	public function renderPhp(array $attributes): string;
	public function renderReact(): string;
}