<?php

declare(strict_types=1);

namespace App\Router;

use Nette;
use Nette\Application\Routers\RouteList;


final class RouterFactory
{
	use Nette\StaticClass;
	public static function createRouter(): RouteList
	{
		$router = new RouteList;
		$router->addRoute('Creator/delete/{id}', 'Creator:delete');
		$router->addRoute('Movie/delete/{id}', 'Movie:delete');
		$router->addRoute('<presenter>/<action>[/<id>]', 'Homepage:default');
		
		return $router;
	}
}
