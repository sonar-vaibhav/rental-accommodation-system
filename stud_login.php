<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['stud_username'];
    $password = $_POST['stud_password'];

    $sql = "SELECT * FROM user_stud WHERE stud_username = '$username' AND stud_password = '$password'";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows == 1) {
        // Start the session
        session_start();

        // Fetch user details
        $user = mysqli_fetch_assoc($result);

        // Store user information in the session
        $_SESSION['user_id'] = $user['stud_id']; // Adjust as per your actual column name
        $_SESSION['username'] = $user['stud_username'];

        // Redirect to the student dashboard
        header("Location: ../CPP/Users/Student/index.php");
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
