<?php

namespace BlockStub\Conditions;

class IsPhp implements ConditionContract {
	public function evaluatePhp(array $attributes): bool {
		return true;
	}

	public function evaluateReact(): string {
		return "false";
	}
}