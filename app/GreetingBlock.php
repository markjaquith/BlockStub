<?php

namespace BlockStub;

use BlockStub\Elements\{Element, P, B};

class GreetingBlock extends Block {
	protected string $title = 'Greeting';
	protected string $handle = 'greeting';

	protected array $attributes = [
		'name' => [
			'type' => 'string',
			'default' => 'Name',
		],
	];

	public function render(): Element {
		return P::make([
			'Hello ',
			B::makeEditable('name'),
			'!',
		]);
	}
}
