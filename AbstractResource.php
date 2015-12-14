<?php
/**
 * @author Algie Caballes <algie.developer@gmail.com>
 * @desc An abstract class that handle api request
 */
namespace Api;

abstract class AbstractResource
{
    protected $method = '';
    protected $request_data = array();
    protected $request = '';
    protected $api_name = '';

    public function __construct($server, $request) {
        header("Accept: application/json");
        header("Content-Type: application/json");
	$this->request = $request;
	$this->method = $server['REQUEST_METHOD'];
	$this->getRequestData();
	$this->api_name = isset($this->request['api_name']) ? $this->request['api_name'] : null;
    }

    protected function getRequestData()
    {
	switch($this->method) {
        case 'DELETE':
	    $this->request_data = $_GET;
            break;
        case 'POST':
            $this->request_data = $_POST;
            break;
        case 'GET':
            $this->request_data = $_GET;
            break;
        case 'PUT':
            $this->request_data = $_GET;
            break;
        default:
            $this->response('Invalid Method', 405);
            break;
        }
    }

    public function processRequest()
    {
	if (method_exists($this, $this->api_name)) {
	    $res = $this->{$this->api_name}($this->request_data);
            return $this->response($res[0], $res[1]);
        } else {
	    return $this->response("Rest api {$this->api_name} not found", 404);
	}
    }

    private function response($data, $status)
    {
        header("HTTP/1.1 " . $status . " " . $this->status($status));
        return json_encode($data);
    }

    private function status($status)
    {
	$status_codes = array(
            200 => 'OK',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            500 => 'Internal Server Error',
        );
        return ($status_codes[$status])?$status_codes[$status]:$status_codes[500];
    }

}

?>
