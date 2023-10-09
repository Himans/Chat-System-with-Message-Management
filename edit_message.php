<!-- edit_message.php -->
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

// Edit message
if (isset($_POST['edit_message']) && isset($_POST['message_id'])) {
    $messageId = $_POST['message_id'];
    $editedMessage = $_POST['edit_message'];

    $sql = "UPDATE messages SET message = '$editedMessage' WHERE id = '$messageId' AND user_id = '{$_SESSION['user_id']}'";
    if (mysqli_query($conn, $sql)) {
        echo "Message edited successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
