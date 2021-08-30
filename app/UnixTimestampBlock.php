<?php

namespace BlockStub;

use BlockStub\Elements\{P, B};

class UnixTimestampBlock extends Block {
	protected string $title = 'Unix Timestamp';
	protected string $handle = 'unix-timestamp';
	protected string $icon = 'clock';

	public function render(): RenderableHtml {
		return P::make([
			'Current Unix Timestamp: ',
			B::make(Elements\UnixTimestamp::make())
		]);
	}
}
