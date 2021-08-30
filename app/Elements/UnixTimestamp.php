<?php

namespace BlockStub\Elements;

use BlockStub\Node;
use BlockStub\BlockContract;

class UnixTimestamp extends Node {
	public function renderPhp(BlockContract $block): string {
		return time();
	}

	public function renderReact(BlockContract $block): string {
		return <<<JS
			el(() => {
				const getTime = () => Math.floor(Date.now() / 1000)
				const [time, setTime] = useState(getTime())

				useEffect(() => {
					const timer = setInterval(() => {
						setTime(getTime())
					}, 50)
					return () => clearInterval(timer)
				}, [])

				return time
			})
		JS;
	}
}