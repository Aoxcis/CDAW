<?php
class Request {

	protected $controllerName;
	protected $uriParameters;
   protected $baseURI;

    public static function getCurrentRequest(){
       // TODO
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

   // intialise controllerName et uriParameters
   // controllerName contient chaîne 'default' ou le nom du controleur s'il est présent dans l'URI (la requête)
   // uriParameters contient un tableau vide ou un tableau contenant les paramètres passés dans l'URI (la requête)
   // e.g. http://eden.imt-nord-europe.fr/~luc.fabresse/api.php
   //    => controllerName == 'default'
   //       uriParameters == []
   // e.g. http://eden.imt-nord-europe.fr/~luc.fabresse/api.php/user/1
   //    => controllerName == 'user'
   //       uriParameters == [ 1 ]
   //
   // Aide :
   // En utlisant la fonction PHP phpinfo et en faisant des tests
   // http://localhost/info.php/test/test
   // on peut voir que
   // $_SERVER['SCRIPT_NAME'] donne le préfixe
   // et que parse_url($_SERVER['REQUEST_URI']
   protected function initControllerAndParametersFromURI(){

      if(isset($_SERVER['REQUEST_URI'])){
         $uri = $_SERVER['REQUEST_URI'];
         $uri = str_replace($this->baseURI, '', $uri);
         $uri = trim($uri, '/');
         $uri = explode('/', $uri);
         $this->controllerName = $uri[0];
         $this->uriParameters = array_slice($uri, 1);
      }
      else{
         $this->controllerName = 'default';
         $this->uriParameters = [];
      }
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

}
