<?php

/**
 * Class for handling HTTP responses
 */
class Response {
    private $statusCode;
    private $body;
    private $headers = [];
    
    /**
     * Constructor
     * 
     * @param int $statusCode HTTP status code
     * @param string $body Response body
     */
    public function __construct($statusCode = 200, $body = '') {
        $this->statusCode = $statusCode;
        $this->body = $body;
        $this->addHeader('Content-Type', 'application/json');
    }
    
    /**
     * Create a standard OK response
     * 
     * @param string $body Response content
     * @return Response Response object
     */
    public static function okResponse($body) {
        return new self(200, $body);
    }
    
    /**
     * Create a standard error response
     * 
     * @param string $message Error message
     * @param int $statusCode HTTP status code
     * @return Response Response object
     */
    public static function errorResponse($message, $statusCode = 400) {
        $body = json_encode(['error' => $message]);
        return new self($statusCode, $body);
    }
    
    /**
     * Add a header to the response
     * 
     * @param string $name Header name
     * @param string $value Header value
     * @return $this For method chaining
     */
    public function addHeader($name, $value) {
        $this->headers[$name] = $value;
        return $this;
    }
    
    /**
     * Get response status code
     * 
     * @return int Status code
     */
    public function getStatusCode() {
        return $this->statusCode;
    }
    
    /**
     * Get response body
     * 
     * @return string Response body
     */
    public function getBody() {
        return $this->body;
    }
    
    /**
     * Send the response to client
     */
    public function send() {
        http_response_code($this->statusCode);
        
        foreach($this->headers as $name => $value) {
            header("$name: $value");
        }
        
        echo $this->body;
    }
}