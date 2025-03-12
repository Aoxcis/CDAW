<?php

/**
 * Class for handling HTTP requests
 */
class Request {
    private $httpMethod;
    private $uri;
    private $headers;
    private $body;
    
    /**
     * Constructor - builds request from globals
     */
    public function __construct() {
        $this->httpMethod = $_SERVER['REQUEST_METHOD'];
        $this->uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
        $this->headers = $this->getRequestHeaders();
        $this->body = file_get_contents('php://input');
    }
    
    /**
     * Get HTTP method
     * 
     * @return string The HTTP method
     */
    public function getHttpMethod() {
        return $this->httpMethod;
    }
    
    /**
     * Get request URI
     * 
     * @return string The URI
     */
    public function getUri() {
        return $this->uri;
    }
    
    /**
     * Get request headers
     * 
     * @return array The headers
     */
    public function getHeaders() {
        return $this->headers;
    }
    
    /**
     * Get raw request body
     * 
     * @return string The raw body
     */
    public function getBody() {
        return $this->body;
    }
    
    /**
     * Get JSON content from request body
     * 
     * @return object Decoded JSON object
     */
    public function jsonContent() {
        return json_decode($this->body);
    }
    
    /**
     * Get request headers from server
     * 
     * @return array Headers array
     */
    private function getRequestHeaders() {
        $headers = [];
        foreach($_SERVER as $key => $value) {
            if (substr($key, 0, 5) === 'HTTP_') {
                $header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
                $headers[$header] = $value;
            }
        }
        return $headers;
    }
}