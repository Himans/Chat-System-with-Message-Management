<?php
// Database connection
$conn = mysqli_connect("localhost", "verifica35", "*7gkczqm8PR6H!", "verifica35");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Register user
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    if (mysqli_query($conn, $sql)) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>