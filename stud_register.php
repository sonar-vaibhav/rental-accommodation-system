<?php
include 'connection.php';

if (isset($_POST['stud_register'])) {
    // Retrieve form data
    $stud_id = uniqid();
    $stud_fname = $_POST['stud_fname'];
    $stud_lname = $_POST['stud_lname'];
    $stud_phno = $_POST['stud_phno'];
    $stud_email = $_POST['stud_email'];
    $stud_gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $stud_username = $_POST['stud_username'];
    $stud_password = $_POST['stud_password'];
    $stud_gd_name = $_POST['stud_gd_name'];
    $stud_gd_phno = $_POST['stud_gd_phno'];
    $stud_edu_bg = $_POST['stud_edu_bg'];
    $stud_college_name = $_POST['stud_college_name'];
    $stud_home_town = $_POST['stud_home_town'];

    // Check if the username already exists
    $checkUsernameQuery = "SELECT * FROM students WHERE stud_username = '$stud_username'";
    $checkUsernameResult = mysqli_query($conn, $checkUsernameQuery);

    // Check if the phone number already exists
    $checkPhnoQuery = "SELECT * FROM students WHERE stud_phno = '$stud_phno'";
    $checkPhnoResult = mysqli_query($conn, $checkPhnoQuery);

    // Check if username or phone number already exists
    if (mysqli_num_rows($checkUsernameResult) > 0) {
        echo "<script>
        alert('Username already exists. Please choose a different one.');
        window.history.back();
        </script>";
        exit();
    }

    if (mysqli_num_rows($checkPhnoResult) > 0) {
        echo "<script>
        alert('Phone Number already exists. Please enter a different one.');
        window.history.back();
        </script>";
        exit();
    }

    // Insert data into the 'students' table
    $insertStudentQuery = "INSERT INTO students (stud_id, stud_photo, stud_fname, stud_lname, stud_phno, stud_email, stud_gender, stud_edu_bg, stud_college_name, stud_hometown, stud_gd_name, stud_gd_phno, stud_username, stud_password) VALUES ('$stud_id', '../images/students/default_student.png', '$stud_fname', '$stud_lname', '$stud_phno', '$stud_email', '$stud_gender', '$stud_edu_bg', '$stud_college_name', '$stud_home_town', '$stud_gd_name', '$stud_gd_phno', '$stud_username', '$stud_password')";

    $insertResult = mysqli_query($conn, $insertStudentQuery);

    if ($insertResult) {
        echo "<script>
        alert('Registration Successful!');
        setTimeout(function(){
            document.write('Redirecting to Home Page . .  .'); 
            window.location.href = 'register.html';
        }, 2000); 
        </script>";
    } else {
        echo "<script>
        alert('Registration Failed.');
        setTimeout(function(){
            document.write('Redirecting to Home Page . .  .'); 
            window.location.href = 'register.html';
        }, 2000);
        </script>";
    }

    mysqli_close($conn);
    exit();
}
?>
