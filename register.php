<?php
include 'db.php';  // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if the phone number is already registered
    $check_user = "SELECT * FROM users WHERE phone = '$phone'";
    $result = mysqli_query($conn, $check_user);

    if (mysqli_num_rows($result) > 0) {
        echo "This phone number is already registered!";
    } else {
        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert the new user into the database with an initial balance of 0.00
        $sql = "INSERT INTO users (fullname, phone, password, balance) VALUES ('$fullname', '$phone', '$hashed_password', 0.00)";
        if (mysqli_query($conn, $sql)) {
            header("Location: home.html");  // Redirect to the home page after successful registration
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>