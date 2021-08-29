<?php

namespace BlockStub;

use BlockStub\Elements\P;

class UnixTimestampBlock extends Block {
	protected string $title = 'Unix Timestamp';
	protected string $handle = 'unix-timestamp';

	public function render(): Elements\Element {
		return P::make([
			'Current Unix Timestamp: ',
			new Elements\UnixTimestamp
		]);
	}
}
