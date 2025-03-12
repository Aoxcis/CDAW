<?php
define('__ROOT_DIR', dirname(dirname(__DIR__)));
require_once __ROOT_DIR . '/model/Response.php';

/**
 * Base Controller class for handling API requests
 */
abstract class Controller {
    protected $name;
    protected $request;
    
    /**
     * Constructor 
     * 
     * @param string $name Controller name
     * @param Request $request The request object
     */
    public function __construct($name, $request) {
        $this->name = $name;
        $this->request = $request;
    }
    
    /**
     * Get controller name
     * 
     * @return string Controller name
     */
    public function getName() {
        return $this->name;
    }
    
    /**
     * Get the request object
     * 
     * @return Request The request object
     */
    public function getRequest() {
        return $this->request;
    }
    
    /**
     * Process the request
     * Each controller implementation should override this method
     * 
     * @return Response The response object
     */
    public abstract function processRequest();
    
    /**
     * Helper method to check if the request uses a specific HTTP method
     * 
     * @param string $method HTTP method to check for
     * @return bool True if the request uses the specified method
     */
    protected function isMethod($method) {
        return $this->request->getHttpMethod() === strtoupper($method);
    }
    
    /**
     * Helper method to validate required JSON fields
     * 
     * @param object $json JSON object to validate
     * @param array $requiredFields Array of field names that must exist
     * @return bool True if all required fields exist
     */
    protected function validateJsonFields($json, $requiredFields) {
        foreach ($requiredFields as $field) {
            if (!isset($json->$field)) {
                return false;
            }
        }
        return true;
    }
    
    /**
     * Create a success response with data
     * 
     * @param mixed $data Response data
     * @return Response Success response
     */
    protected function success($data) {
        return Response::okResponse($data);
    }
    
    /**
     * Create an error response
     * 
     * @param string $message Error message
     * @param int $statusCode HTTP status code
     * @return Response Error response
     */
    protected function error($message, $statusCode = 400) {
        return new Response($statusCode, $message);
    }
}