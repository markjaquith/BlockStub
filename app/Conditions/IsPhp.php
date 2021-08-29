<?php

namespace BlockStub\Conditions;

use BlockStub\BlockContract;

class IsPhp implements ConditionContract {
	public function evaluatePhp(BlockContract $block): bool {
		return true;
	}

	public function evaluateReact(): string {
		return "false";
	}
}