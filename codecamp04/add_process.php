<?php
require_once 'connection.php';
$name = isset($_POST['name']) ? $_POST['name'] : '';
$description = isset($_POST['description']) ? $_POST['description'] : '';


$query = "INSERT INTO categories(name,parent_id,thumbnail,slug,description,created_at) 
VALUES ('" . $name . "',null,null,null, '" . $description . "', null)";

$status = $conn->query($query);

if ($status) {

    $query = "select  * from categories";

    $data = $conn->query($query);

    $categories = [];

    while ($row = $data->fetch_assoc()) {
        $categories[] = $row;
    }

    echo json_encode([
        'error' => false,
        'message' => 'Tạo mới thành công',
        'data' => $categories
    ]);
} else {
    echo json_encode([
        'error' => true,
        'message' => 'Tạo mới thất bại'
    ]);
}