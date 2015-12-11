<?php
namespace Api;

require_once('AbstractResource.php');
require_once('model/Model.php');

use Api\AbstractResource;
use Model\Query;

class ApiResource extends AbstractResource
{
    public function __construct($server, $request)
    {
	parent::__construct($server, $request);
    }

    protected function product()
    {
	// GET REQUEST
        if ($this->method == 'GET') {
	    // REQUEST PRODUCT BY ITS ID
	    if (isset($this->request_data['id'])) {
		$query = new Query($this->api_name);
		return $query->getDataById($this->request_data['id']);
	    } else {
		//REQUEST ALL PRODUCTS
		$query = new Query($this->api_name);
                return $query->getAllData();
	    }
        } else if ($this->method == 'POST') {
	    $query = new Query($this->api_name);
	    if (!empty($this->request_data))
		return $query->addData($this->request_data);	
	    else
		return "Post data is empty.";
        }
     }
 }
?>
