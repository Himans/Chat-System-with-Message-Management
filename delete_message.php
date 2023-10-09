<!-- delete_message.php -->
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

// Delete message
if (isset($_POST['delete_message']) && isset($_POST['message_id'])) {
    $messageId = $_POST['message_id'];

    $sql = "DELETE FROM messages WHERE id = '$messageId' AND user_id = '{$_SESSION['user_id']}'";
    if (mysqli_query($conn, $sql)) {
        echo "Message deleted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
