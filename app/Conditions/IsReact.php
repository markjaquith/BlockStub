<?php

namespace BlockStub\Conditions;

use BlockStub\Elements\NodeContract;

class IsReact implements ConditionContract {
	public function evaluatePhp(array $attributes): bool {
		return false;
	}

	public function evaluateReact(): string {
		return "true";
	}
}