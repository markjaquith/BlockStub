<?php

namespace BlockStub\Conditions;

use BlockStub\Elements\NodeContract;

interface ConditionContract {
	public function evaluatePhp(): bool;
	public function evaluateReact(): string;
}
