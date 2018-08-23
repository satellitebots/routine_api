<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../../config/database.php';
 
// instantiate purpose object
include_once '../../entity/purpose.php';
 
$database = new Database();
$db = $database->getConnection();
 
$purpose = new Purpose($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// set purpose property values
$purpose->name = $data->name;
$purpose->description = $data->description;
 
// create the purpose
if($purpose->create()){
    echo '{';
        echo '"message": "purpose was created."';
    echo '}';
}
 
// if unable to create the purpose, tell the user
else{
    echo '{';
        echo '"message": "Unable to create purpose."';
    echo '}';
}
?>