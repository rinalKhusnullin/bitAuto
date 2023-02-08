<?php

namespace ES\Routing;

class Router
{

	/** @var Route */

	private static array $routes = [];

	public static function add(string $method, string $uri, $action) : void
	{
		self::$routes[] = new Route($method, $uri, \Closure::fromCallable($action));
	}

	public static function get(string $uri, $action) : void
	{
		self::add('GET', $uri, $action);
	}

	public static function post(string $uri, callable $action) : void
	{
		self::add('POST', $uri, $action);
	}

	public static function find(string $method, string $uri): ?Route
	{
		foreach (self::$routes as $route)
		{
			[$path] = explode('?', $uri);
			if ($route->method !== $method)
			{
				continue;
			}
			if ($route->match($path))
			{
				return $route;
			}
		}
		return null;
	}
}