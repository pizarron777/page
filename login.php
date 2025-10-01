<?php
session_start();

$servername = "localhost";
$dbname = "registration";  // Name of database in SQL
$dbuser = "root";        // Default XAMPP user
$dbpass = "";            // Default XAMPP password

// Create connection
$conn = new mysqli($servername, $dbuser, $dbpass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_user = $_POST['username'];
    $input_pass = $_POST['password'];

    // Fetch user by username
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $input_user);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify password against hash
        if (password_verify($input_pass, $user['password'])) {
            $_SESSION['username'] = $user['username'];

            // Redirect to welcome page
            header("Location: welcome.php");
            exit();
        } else {
            // Wrong password
            header("Location: login.html?error=Incorrect password");
            exit();
        }
    } else {
        // Username not found
        header("Location: login.html?error=User does not exist");
        exit();
    }
}
?>
