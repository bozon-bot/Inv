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

$id = isset($_POST['id']) ? $_POST['id'] : '';
$balance = isset($_POST['balance']) ? $_POST['balance'] : '';

if ($id && $balance !== '') {
    $sql = "UPDATE users SET balance = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("di", $balance, $id);

    if ($stmt->execute()) {
        echo "Balance updated successfully!";
    } else {
        echo "Error updating balance: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid input.";
}

$conn->close();
?>