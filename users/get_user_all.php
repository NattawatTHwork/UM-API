<?php
include_once '../include/header.php';
include_once '../vendor/firebase/php-jwt/src/JWT.php';
include_once '../vendor/firebase/php-jwt/src/Key.php';
include_once '../auth/authorization.php';
include_once '../class/users.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $users = new Users();
        $userList = $users->getUserAll();

        if ($userList !== false) {
            http_response_code(200);
            echo json_encode(array("status" => "success", "data" => $userList));
        } else {
            http_response_code(204);
            echo json_encode(array("status" => "success", "message" => "No users found."));
        }
    } else {
        throw new Exception('Method not allowed.');
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(array("status" => "error", "message" => $e->getMessage()));
}
?>
