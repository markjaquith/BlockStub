<?php

namespace BlockStub\Elements;

use BlockStub\Renderable;

class UnixTimestamp implements Renderable {
	public function renderPhp(array $attributes): string {
		return time();
	}

	public function renderReact(): string {
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