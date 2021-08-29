<?php

namespace BlockStub;

class UnixTimestampBlock extends Block {
	protected string $title = 'Unix Timestamp';
	protected string $handle = 'unix-timestamp';

	public function render(): Elements\NodeContract {
		$p = new Elements\P;
		$p->add([
			'Current Unix Timestamp: ',
			new Elements\UnixTimestamp
		]);

		return $p;
	}
}
