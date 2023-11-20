<?php
include "./autoload.php";

$user = new User();

$streamInput = file_get_contents('php://input');

if (strpos($streamInput, ':')) {
    $jsonData = true;
} else {
    $jsonData = false;
}

$request = $jsonData ? json_decode($streamInput, 1) :  $_REQUEST;
$action = "unknown";
//print_r($request);
if (isset($request['action'])) {
    $action = trim($request['action']);
    unset($request['action']);
}
switch ($action) {
    case 'searchUser':
        $result = $user->searchUser($request['userName']);
        break;

    case 'fileUpload':
        $result = $user->uploadFile($_FILES['image']);
        break;

    case 'getImage':
        $result = $user->getImage();
        //header('Content-Type:image/png');
        break;
    case 'downloadImage':
        $result = $user->downloadImage();
        //header('Content-Type:image/png');
        break;

    default:
        $result = invalidRequest();
        break;
}

if (is_array($result)) {
    header('Content-Type:application/json');
    echo json_encode($result);
    exit();
} else {
    //header('Content-Type:image/png');
    echo $result;
    exit();
}

function invalidRequest($message = null)
{
    http_response_code(201);
    $response = new stdClass();
    $response->responseCode = 203;
    $response->responseDescription = $message ? $message : 'Invalid Request';
    return (array)$response;
}
