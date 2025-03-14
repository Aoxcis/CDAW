<?php
class Request {

	protected $controllerName;
	protected $uriParameters;
   protected $baseURI;

    public static function getCurrentRequest(){
      return new Request();
    }

   public function __construct() {
      $this->initBaseURI();
      $this->initControllerAndParametersFromURI();
   }

   // intialise baseURI
   // e.g. http://eden.imt-nord-europe.fr/~luc.fabresse/api.php => __BASE_URI = /~luc.fabresse
   // e.g. http://localhost/CDAW/api.php => __BASE_URI = /CDAW
   protected function initBaseURI() {
      $this->baseURI = 'http://localhost:8888/BackEnd/tp3/api.php';
   }


   protected function initControllerAndParametersFromURI() {
      if (isset($_SERVER['PATH_INFO']) && !empty($_SERVER['PATH_INFO'])) {
         // PATH_INFO already contains the path after the script name ("/users")
         $path = trim($_SERVER['PATH_INFO'], '/');
         $parts = explode('/', $path);
         
         if (!empty($parts[0])) {
            $this->controllerName = $parts[0];
            $this->uriParameters = array_slice($parts, 1);
         } else {
            $this->controllerName = 'default';
            $this->uriParameters = [];
         }
      } else {
         $this->controllerName = 'default';
         $this->uriParameters = [];
      }
      
      // For debugging
      // error_log("Controller: " . $this->controllerName);
      // error_log("Parameters: " . print_r($this->uriParameters, true));
   }

   // ==============
   // Public API
   // ==============

	// retourne le name du controleur qui doit traiter la requête courante
   public function getControllerName() {
      return $this->controllerName;
   }

	// retourne la méthode HTTP utilisée dans la requête courante
   public function getHttpMethod() {
      return $_SERVER["REQUEST_METHOD"];
   }

   public function getParams() {
      return $this->uriParameters;
   }
}
