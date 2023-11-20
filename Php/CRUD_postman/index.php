<?php
include "./autoload.php";
$user = new User();

// $streamInput = file_get_contents('php://input');
// if (strpos($streamInput, ':')) {
//     $jsonData = true;
// } else {
//     $jsonData = false;
// }
// $request = $jsonData ? json_decode($streamInput, 1) : $_REQUEST;
// $action = "unknown";

// if (isset($request['action'])) {
//     $action = trim($request['action']);
//     unset($request['action']);
// }
// $result = "";

switch ('getUser') { // You need to match action not methods,
    case "getUser":
        // $result = $user->selectQuery($request['fields'] ?? [], $request['conditions'] ?? []);
        $result = $user->selectQuery([], ['email' => 'sainikeshav0009@gmail.com', 'password' => '1234']);
        break;
    case "updateUser":
        $result = $user->updateQuery($request["existing"], $request["new"]);
        break;
    case "deleteUser":
        $result = $user->deleteQuery($request['fields']);
        break;
    case "addUser":
        $result = $user->insertQuery($request['fields']);;
        break;
    default:
        $result = invalidRequest();
        break;
}
print_r($result);
// if (is_array($result)) {
//     header('Content-Type:application/json');
//     echo json_encode($result);
//     exit();
// } else {
//     echo $result;
//     exit();
// }

// function invalidRequest($message = null)
// {
//     http_response_code(201);
//     $response = new stdClass();
//     $response->responseCode = 203;
//     $response->responseDescription = $message ? $message : 'Invalid Request';
//     return (array)$response;
// }
