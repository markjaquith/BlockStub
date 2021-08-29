<?php

namespace BlockStub;

use BlockStub\Conditions\{IsPhp, IsReact};
use BlockStub\Elements\{P, B};

class AnnounceRenderingEngineBlock extends Block {
	protected string $title = 'Announce Rendering Engine';
	protected string $handle = 'rendering-engine';

	public function render(): Elements\Element {
		$p = P::make('This sentence was rendered on both engines. ');
		
		// Chaining with array.
		$p->if(new IsPhp)
			->add([
				'But this one was only rendered on ',
				B::make('PHP'),
				'.'
			]);

		// Chaining with individual calls.
		$p->if(new IsReact)
			->add('But this one was only rendered on ')
			->add(B::make('React'))
			->add('.');

		return $p;
	}
}
