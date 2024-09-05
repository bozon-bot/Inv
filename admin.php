<?php
$servername = "localhost";
$username = "softlife_db";
$password = "Hicks2005";
$dbname = "softlife_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$phone = isset($_GET['phone']) ? $_GET['phone'] : '';

$sql = "SELECT id, fullname, phone, balance FROM users WHERE phone LIKE ?";
$stmt = $conn->prepare($sql);
$searchPhone = "%{$phone}%";
$stmt->bind_param("s", $searchPhone);
$stmt->execute();
$result = $stmt->get_result();

$users = array();
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

echo json_encode($users);

$stmt->close();
$conn->close();
?>