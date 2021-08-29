<?php

namespace BlockStub\Conditions;

use BlockStub\BlockContract;

class IsReact implements ConditionContract {
	public function evaluatePhp(BlockContract $block): bool {
		return false;
	}

	public function evaluateReact(BlockContract $block): string {
		return "true";
	}
}