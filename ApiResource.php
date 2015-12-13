<?php
/**
 * @author Algie Caballes <algie.developer@gmail.com>
 * @desc Api resource page that handle api request
 */
namespace Api;

require_once('AbstractResource.php');
require_once('model/Model.php');

use Api\AbstractResource;
use Model\Query;

class ApiResource extends AbstractResource
{
    protected $authenticate = true;
    public function __construct($server, $request)
    {
	parent::__construct($server, $request);
	if (!isset($server['HTTP_AUTHENTICATON_HEADER']) || $server['HTTP_AUTHENTICATON_HEADER'] != '12345')
	    $this->authenticate = false;
    }

    protected function product()
    {
	// GET REQUEST
        if ($this->method == 'GET') {
	    if (!$this->authenticate)
		return "Error authenticating your access token.";
	    // REQUEST PRODUCT BY ITS ID
	    if (isset($this->request_data['id'])) {
		$query = new Query($this->api_name);
		return $query->getDataById($this->request_data['id']);
	    } else {
		//REQUEST ALL PRODUCTS
		$query = new Query($this->api_name);
                return $query->getAllData();
	    }

	// POST REQUEST
        } else if ($this->method == 'POST') {
	    if (!$this->authenticate)
                return "Error authenticating your access token.";
	    $query = new Query($this->api_name);
	    if (!empty($this->request_data))
		return $query->addData($this->request_data);	
	    else
		return "Post data is empty.";

	// DELETE REQUEST
        } else if ($this->method == 'DELETE') {
	    if (!$this->authenticate)
                return "Error authenticating your access token.";
	    if (isset($this->request_data['id'])) {
                $query = new Query($this->api_name);
                return $query->removeData($this->request_data['id']);
            } else {
		return "Id is not defined.";
	    }
	
	//PUT  REQUEST
        } else if ($this->method == 'PUT') {
	    if (!$this->authenticate)
                return "Error authenticating your access token.";
            if (isset($this->request_data['id'])) {
                $query = new Query($this->api_name);
                return $query->updateData($this->request_data);
            } else {
                return "Id is not defined for PUT request.";
            }
        }
     }
 }
?>
