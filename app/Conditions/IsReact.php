<?php

namespace BlockStub\Conditions;

class IsReact implements ConditionContract {
	public function evaluatePhp(array $attributes): bool {
		return false;
	}

	public function evaluateReact(): string {
		return "true";
	}
}