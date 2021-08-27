<?php

namespace BlockStub;

interface BlockContract {
	public function renderJs(): array;
	public function renderPhp(): string;
	public function getHandle(): string;
	public function getName(): string;
	public function getAttributes(): array;
}