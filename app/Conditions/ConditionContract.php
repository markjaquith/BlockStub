<?php

namespace BlockStub\Conditions;

use BlockStub\BlockContract;

interface ConditionContract {
	public function evaluatePhp(BlockContract $block): bool;
	public function evaluateReact(BlockContract $block): string;
}
