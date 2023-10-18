<?php
include "./autoload.php";

$user = new User();

$streamInput = file_get_contents('php://input');
if (strpos($streamInput, ':')) {
    $jsonData = true;
} else {
    $jsonData = false;
}
$request = $jsonData ? json_decode($streamInput, 1) : $_REQUEST;
$action = "unknown";

if (isset($request['action'])) {
    $action = trim($request['action']);
    unset($request['action']);
}

switch ($action) {
    case 'getUser':
        // print_r($request->fields);
        // print_r($request->conditions);
        $result = $user->selectQuery($request['fields'] ?? [], $request['conditions'] ?? []);;
        break;
    case 'updateUser':
        $result = $user->updateQuery($request->prev, $request->newOne);
        break;
    case 'deleteUser':
        $result = $user->deleteQuery($request);
        break;
    case 'insertUser':
        $result = $user->insertQuery($request);
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
