<!-- send_message.php -->
<?php
// Start session
session_start();

// Database connection
$conn = mysqli_connect("localhost", "verifica35", "*7gkczqm8PR6H!", "verifica35");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("You are not logged in!");
}

// Send message
if (isset($_POST['message'])) {
    $userId = $_SESSION['user_id'];
    $message = $_POST['message'];

    $sql = "INSERT INTO messages (user_id, message) VALUES ('$userId', '$message')";
    if (mysqli_query($conn, $sql)) {
        echo "Message sent successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>