<?php

namespace BlockStub\Elements;

interface NodeContract {
	public function renderPhp(): string;
	public function renderReact(): string;
}