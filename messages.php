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

// Display chat window and messages
?>
<!DOCTYPE html>
<html>
<head>
    <title>Chat</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Chat</h2>
        <div id="chat-window">
            <?php
            // Retrieve and display messages
            $sql = "SELECT messages.*, users.username FROM messages INNER JOIN users ON messages.user_id = users.id";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $messageId = $row['id'];
                    $username = $row['username'];
                    $message = $row['message'];

                    echo "<div><strong>$username:</strong> $message</div>";

                    // Add Edit and Delete buttons for the user's own messages
                    if ($_SESSION['user_id'] == $row['user_id']) {
                        echo "<form action='messages.php' method='POST'>";
                        echo "<input type='hidden' name='message_id' value='$messageId'>";
                        echo "<input type='text' name='edit_message' placeholder='Edit message'>";
                        echo "<input type='submit' value='Edit'>";
                        echo "</form>";

                        echo "<form action='messages.php' method='POST'>";
                        echo "<input type='hidden' name='message_id' value='$messageId'>";
                        echo "<input type='submit' name='delete_message' value='Delete'>";
                        echo "</form>";
                    }

                    echo "<br>";
                }
            } else {
                echo "No messages found.";
            }
            ?>
        </div>
        <form action="messages.php" method="POST">
            <input type="text" name="message" placeholder="Enter your message" required><br>
            <input type="submit" value="Send">
        </form>
    </div>
</body>
</html>
<?php
mysqli_close($conn);
?>