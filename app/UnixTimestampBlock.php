<?php

namespace BlockStub;

class UnixTimestampBlock extends Block {
	protected string $title = 'Unix Timestamp';
	protected string $handle = 'unix-timestamp';

	public function render(): Elements\Element {
		return Elements\P::make([
			'Current Unix Timestamp: ',
			new Elements\UnixTimestamp
		]);
	}
}
