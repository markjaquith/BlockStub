<?php

namespace BlockStub\Conditions;

use BlockStub\Elements\NodeContract;

class IsReact implements ConditionContract {
	public function evaluatePhp(): bool {
		return false;
	}

	public function evaluateReact(): string {
		return "true";
	}
}