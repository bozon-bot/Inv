<?php
include 'db.php';  // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if the phone number exists
    $sql = "SELECT * FROM users WHERE phone = '$phone'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // User found, now check the password
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {
            // Correct password, redirect to home page
            header("Location: home.html");
        } else {
            echo "Incorrect password!";
        }
    } else {
        echo "Phone number not found!";
    }
}
?>