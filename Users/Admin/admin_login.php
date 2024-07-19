<?php
include("../connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['stud_username'];
    $password = $_POST['stud_password'];

    $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows == 1) {
        session_start();
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $user['admin_id'];
        header("Location: index.php");
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
