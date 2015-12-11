<?php
/**
 * @author Algie Caballes <algie.developer@gmail.com>
 * @des index that handles requests
 */
require_once('ApiResource.php');
use Api\ApiResource;

try {
    $resource = new ApiResource($_SERVER, $_REQUEST);
    echo $resource->processRequest();
} catch (Exception $e) {
    echo json_encode(Array('error' => $e->getMessage()));
}

?>
