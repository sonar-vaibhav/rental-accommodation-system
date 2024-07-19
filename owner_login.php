<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['owner_username'];
    $password = $_POST['owner_password'];

    $sql = "SELECT * FROM user_owner WHERE owner_username = '$username' AND owner_password = '$password'";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows == 1) {
        session_start();
        // Fetch user details
        $user = mysqli_fetch_assoc($result);
        // Store user information in the session
        $_SESSION['user_id'] = $user['owner_id']; 
        $_SESSION['username'] = $user['owner_username'];
        // Redirect to the student dashboard
        header("Location: ../CPP/Users/Room Owner/index.php");
        exit();
    } else {
        // Authentication failed
        echo '<script>
            alert("Login failed. Invalid credentials . . !");
            window.location.href = "login.html";
        </script>';
    }
}
?>
