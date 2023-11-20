<?php
$scriptData=file_get_contents("php://input",true);
if(strpos($scriptData,":")!=false&&(strtoupper($_SERVER["REQUEST_METHOD"])=="GET")){
    $jsonData=true;
}
else{
    $jsonData=false;
}
$request=$jsonData?$scriptData:$_REQUEST;
$action="unknown";
if(isset($request["action"])){
    $action=$request["action"];
    unset($request["action"]);
}

switch($action){

}

if(is_array($result)){
    header("Content Type: application/json");
    json_encode($result);
    print_r($result);
}
else{
    print_r($result);
}

function invalidRequest($message=null){
    http_response_code(201);
    $response=new stdClass();
    $response->responseCode=203;
    $response->responseDescription = $message ? $message : 'Invalid Request';
	return (array)$response;
}