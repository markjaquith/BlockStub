<?php

namespace BlockStub;

class DateBlock extends Block {
	public function renderPhp(): string {
		return '<p>PHP: ' . time() . '</p>';
	}

	public function renderJs(): array {
		return ['p', '"JS: " + Math.floor(Date.now() / 1000)'];
	}
}

add_action('blockstub_init', function (BlockFactory $blocks) {
	$blocks->addBlock(
		new DateBlock('date', 'Date')
	);
});
