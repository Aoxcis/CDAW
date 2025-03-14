<?php

class UserController extends Controller {

	public function __construct($name, $request) {
		parent::__construct($name, $request);
	}

	public function processRequest()
    {
        switch ($this->request->getHttpMethod()) {
            case 'GET':
				return $this->getAllUsers();
                break;
        }
        return Response::errorResponse("unsupported parameters or method in users");
    }

    protected function getAllUsers()
    {
        $users = User::getUserById($this->request->getParams()[0]);
        if($users == null){
            return Response::errorResponse("User not found");
        }
        $response = Response::okResponse(json_encode($users));
        return $response;
    }
}
