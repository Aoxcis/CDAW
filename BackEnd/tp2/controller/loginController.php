<?php
define('__ROOT_DIR', dirname(dirname(__DIR__)));
include_once __ROOT_DIR . '/libs/php-jwt/src/BeforeValidException.php';
include_once __ROOT_DIR . '/libs/php-jwt/src/ExpiredException.php';
include_once __ROOT_DIR . '/libs/php-jwt/src/SignatureInvalidException.php';
include_once __ROOT_DIR . '/libs/php-jwt/src/JWT.php';
// Add this line to include the Controller class
require_once __DIR__ . '/Controller.php';
use \Firebase\JWT\JWT;

class LoginController extends Controller {

    public function __construct($name, $request) {
        parent::__construct($name, $request);
    }

    public function processRequest() {
        if($this->request->getHttpMethod() !== 'POST')
            return Response::errorResponse('{ "message" : "Unsupported endpoint" }' );

        $json = $this->request->jsonContent();

        if(!isset($json->pwd) || !isset($json->login)) {
            return new Response(422, "login and pwd fields are mandatory");
        }

        $userModel = new UserModel();
        $user = $userModel->tryLogin($json->login);
        if(empty($user) || !hash_equals($json->pwd, $user->password())) {
            return new Response(422, "wrong credentials");
        }

      // generate json web token  
        $issued_at = time();
        $expiration_time = $issued_at + (60 * 60); // valid for 1 hour

        $token = array(
            "iat" => $issued_at,
            "exp" => $expiration_time,
            "iss" => JWT_ISSUER,
            "data" => array(
                "id" => $user->id(),
                "firstname" => $user->firstname(),
                "lastname" => $user->lastname(),
                "email" => $user->email()
            )
        );

        // Update the JWT encoding to include algorithm (HS256 is standard)
        $jwt = JWT::encode($token, JWT_BACKEND_KEY, 'HS256');
        $jsonResult = json_encode(
                array(
                "jwt_token" => $jwt
                )
        );

        return Response::okResponse($jsonResult);
    }
}