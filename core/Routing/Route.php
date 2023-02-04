<?php

namespace ES\Routing;

class Route
{
	public function __construct(
		public readonly string $method,
		public readonly string $uri,
		public readonly \Closure $action,
	)
	{
	}

}
