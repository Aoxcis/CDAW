<?php

/*
* Analyses a request, created the right Controller passing it the request
*/

class Dispatcher {

	public static function dispatch($request) {
		return static::dispatchToController($request->getControllerName(),$request);
	}

	public static function dispatchToController($controllerName, $request) {
      // TODO
      // une requête GET /users doit retourner new UsersController($controllerName, $request)
      // une requête GET /user/1 doit retourner new UserController($controllerName, $request)

		if($controllerName == 'users'){
			return new UsersController($controllerName, $request);
		}

		if($controllerName == 'user'){
			var_dump($controllerName);
			var_dump($request);
			return new UserController($controllerName, $request);
		}

		else{
			return new DefaultController($controllerName, $request);
		}
	}
}
