<?php

namespace BlockStub\Conditions;

use BlockStub\Elements\NodeContract;

class IsPhp implements ConditionContract {
	public function evaluatePhp(array $attributes): bool {
		return true;
	}

	public function evaluateReact(): string {
		return "false";
	}
}