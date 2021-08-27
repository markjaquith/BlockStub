<?php

namespace BlockStub;

class UnixTimestampBlock extends Block {
	public function render(): Elements\NodeContract {
		$p = new Elements\P;
		$p->addText('Current Unix Timestamp: ');
		$p->addChild(new Elements\UnixTimestamp);

		return $p;
	}
}
