<?php

namespace BlockStub;

use BlockStub\Conditions\{IsPhp, IsReact};
use BlockStub\Elements\{NodeContract, P, B};

class AnnounceRenderingEngineBlock extends Block {
	public function render(): Elements\NodeContract {
		$isPhp = new IsPhp();
		$isReact = new IsReact();

		$p = P::make();
		$p->addText('This sentence was rendered on both engines. ');
		
		$p->if($isPhp)
			->addText('But this one was only rendered on ')
			->addChild(B::make('PHP'))
			->addText('.');

		$p->if($isReact)
			->addText('But this one was only rendered on ')
			->addChild(B::make('React'))
			->addText('.');

		return $p;
	}
}
