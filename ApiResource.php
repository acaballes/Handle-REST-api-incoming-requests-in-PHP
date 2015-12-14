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
		return array("Error authenticating your access token.", 405);
	    // REQUEST PRODUCT BY ITS ID
	    if (isset($this->request_data['id'])) {
		$query = new Query($this->api_name);
		return array($query->getDataById($this->request_data['id']), 200);
	    } else {
		//REQUEST ALL PRODUCTS
		$query = new Query($this->api_name);
                return array($query->getAllData(), 200);
	    }

	// POST REQUEST
        } else if ($this->method == 'POST') {
	    if (!$this->authenticate)
                return array("Error authenticating your access token.", 405);
	    $query = new Query($this->api_name);
	    if (!empty($this->request_data))
		return array($query->addData($this->request_data), 200);	
	    else
		return array("Post data is empty.", 500);

	// DELETE REQUEST
        } else if ($this->method == 'DELETE') {
	    if (!$this->authenticate)
                return array("Error authenticating your access token.", 405);
	    if (isset($this->request_data['id'])) {
                $query = new Query($this->api_name);
                return array($query->removeData($this->request_data['id']),200);
            } else {
		return array("Id is not defined.", 500);
	    }
	
	//PUT  REQUEST
        } else if ($this->method == 'PUT') {
	    if (!$this->authenticate)
                return array("Error authenticating your access token.", 405);
            if (isset($this->request_data['id'])) {
                $query = new Query($this->api_name);
                return array($query->updateData($this->request_data), 200);
            } else {
                return array("Id is not defined for PUT request.", 500);
            }
        }
     }
 }
?>
