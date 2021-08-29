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

	public function render(): Elements\NodeContract {
		return Elements\P::make()->add([
			'Hello ',
			Elements\B::makeEditable($this->getAttribute('name')),
			'!',
		]);
	}
}
