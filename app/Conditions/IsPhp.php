<?php

namespace BlockStub\Conditions;

use BlockStub\Elements\NodeContract;

class IsPhp implements ConditionContract {
	public function evaluatePhp(): bool {
		return true;
	}

	public function evaluateReact(): string {
		return "false";
	}
}