# Chat-System-with-Message-Management
The script was authored by OpenAI's GPT
This code appears to be a collection of PHP scripts and an HTML form for a user login and registration system with a simple chat functionality. Here's a breakdown of each script and its purpose:

1. `delete_message.php`: This script is responsible for deleting a message from the database. It first checks if the user is logged in, then deletes the specified message if it belongs to the logged-in user.

2. `edit_message.php`: This script allows the user to edit a message. It checks if the user is logged in, then updates the specified message with the edited content if it belongs to the logged-in user.

3. `login.php`: This script handles the user login process. It checks if the provided username and password match the records in the database. If the login is successful, it sets the user's session and redirects them to the `messages.php` page.

4. `messages.php`: This script displays a chat window and allows users to send, edit, and delete messages. It retrieves messages from the database and displays them along with the username. The user can only edit or delete their own messages.

5. `register.php`: This script handles user registration. It takes the provided username and password, hashes the password, and inserts the user's information into the database.

6. `send_message.php`: This script is responsible for sending a message. It checks if the user is logged in, then inserts the message into the database along with the user ID.

7. `user_registration.html`: This is an HTML form for user registration. It prompts the user to enter a username and password and submits the form to the `register.php` script.

Overall, these scripts work together to create a basic user login and registration system with a chat feature. It allows users to log in, register, send messages, edit their own messages, and delete their own messages.
