<?php

namespace BlockStub;

class MagicHtmlBlock extends Block {
	protected string $title = 'Magic HTML Block';
	protected string $handle = 'magic-html';
	protected string $icon = 'clock';

	public function render(): RenderableHtml {
		return $this->renderHtml(<<<HTML
			<p>
				How the <b class="big">actual heck</b> does this work?:
				<el class="\BlockStub\Elements\UnixTimestamp" />
			</p>'
		HTML);
	}
}
