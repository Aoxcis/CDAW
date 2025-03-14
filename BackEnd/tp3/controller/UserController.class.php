<?php

class UserController extends Controller {

	public function __construct($name, $request) {
		parent::__construct($name, $request);
	}

	public function processRequest()
    {
        switch ($this->request->getHttpMethod()) {
            case 'GET':
				return $this->getUserById();
                break;
            case 'PUT':
                return $this->updateUser();
                break;
        }
        return Response::errorResponse("unsupported parameters or method in users");
    }

    protected function getUserById() {
        $users = User::getUserById($this->request->getParams()[0]);
        if($users == null){
            return Response::errorResponse("User not found");
        }
        $response = Response::okResponse(json_encode($users));
        return $response;
    }

    protected function updateUser() {
        $userId = $this->request->getParams()[0];
        $userData = User::getUserById($userId);
        
        if($userData == null){
            return Response::errorResponse("User not found");
        }
        
        $data = json_decode(file_get_contents('php://input'), true);
        $data['id'] = $userId;

        
        var_dump($data);
        User::update($data);
        $updatedUserData = User::getUserById($userId);
        $response = Response::okResponse(json_encode($updatedUserData));
        return $response;
    }
}
