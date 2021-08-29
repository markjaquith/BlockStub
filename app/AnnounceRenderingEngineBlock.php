<?php

namespace BlockStub;

use BlockStub\Conditions\{IsPhp, IsReact};
use BlockStub\Elements\{NodeContract, P, B};

class AnnounceRenderingEngineBlock extends Block {
	protected string $title = 'Announce Rendering Engine';
	protected string $handle = 'rendering-engine';

	public function render(): Elements\NodeContract {
		$isPhp = new IsPhp();
		$isReact = new IsReact();

		$p = P::make('This sentence was rendered on both engines. ');
		
		// Chaining with array.
		$p->if($isPhp)
			->add([
				'But this one was only rendered on ',
				B::make('PHP'),
				'.'
			]);

		// Chaining with individual calls.
		$p->if($isReact)
			->add('But this one was only rendered on ')
			->add(B::make('React'))
			->add('.');

		return $p;
	}
}
