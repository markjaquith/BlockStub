<?php

namespace BlockStub;

class GreetingBlock extends Block {
	protected string $title = 'Greeting';
	protected string $handle = 'greeting';
	protected string $icon = 'admin-users';

	protected array $attributes = [
		'name' => [
			'type' => 'string',
			'default' => 'Name',
		],
	];

	public function render(): RenderableHtml {
		return $this->renderHtml(<<<HTML
			<p>Hello <b x-bind="name"></b>! (Your name is <span x-text="name"></span>)</p>
		HTML);
	}
}
