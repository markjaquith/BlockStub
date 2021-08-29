<?php

namespace BlockStub;

class GreetingBlock extends Block {
	protected string $title = 'Greeting';
	protected string $handle = 'greeting';

	protected array $attributes = [
		'name' => [
			'type' => 'string',
			'default' => 'Name',
		],
	];

	public function render(): Elements\Element {
		return new Elements\P([
			'Hello ',
			Elements\B::makeEditable($this->getAttribute('name')),
			'!',
		]);
	}
}
