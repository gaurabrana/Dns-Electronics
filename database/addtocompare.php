<?php
include('connect.php');

$response = [];

if (!isset($_SESSION['id'])) {
    $response['statusCode'] = 203;    
    echo json_encode($response);
    exit;
}

if (!isset($_POST['action']) || empty($_POST['action'])) {
    $response['statusCode'] = 202;    
    echo json_encode($response);
    exit;
}

$userId = intval($_SESSION['id']);
$code = mysqli_real_escape_string($conn, $_POST['action']);

$query = "SELECT * FROM compare WHERE customer_id = ? AND product_code = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("is", $userId, $code);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $response['statusCode'] = 204;    
} else {
    $insert = $conn->prepare("INSERT INTO compare (customer_id, product_code) VALUES (?, ?)");
    $insert->bind_param("is", $userId, $code);
    if ($insert->execute()) {
        $response['statusCode'] = 200;        
    } else {
        $response['statusCode'] = 201;        
    }
    $insert->close();
}

$stmt->close();
$conn->close();

echo json_encode($response);
