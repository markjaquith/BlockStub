<?php

namespace BlockStub\Conditions;

interface ConditionContract {
	public function evaluatePhp(array $attributes): bool;
	public function evaluateReact(): string;
}
