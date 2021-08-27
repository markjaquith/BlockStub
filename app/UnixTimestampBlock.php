<?php

namespace BlockStub;

class UnixTimestampBlock extends Block {
	public function render(): Elements\NodeContract {
		$p = new Elements\P;
		$p->add([
			'Current Unix Timestamp: ',
			new Elements\UnixTimestamp
		]);

		return $p;
	}
}
