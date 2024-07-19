<?php
include 'connection.php';

if (isset($_POST['owner_register'])) {
    // Retrieve form data
    $owner_id = uniqid();
    $owner_fname = $_POST['owner_fname'];
    $owner_lname = $_POST['owner_lname'];
    $owner_phno = $_POST['owner_phno'];
    $owner_email = $_POST['owner_email'];
    $owner_username = $_POST['owner_username'];
    $owner_password = $_POST['owner_password'];

    // Check if the username or phone number already exists
    $checkDuplicateQuery = "SELECT * FROM owners WHERE owner_username = '$owner_username' OR owner_phno = '$owner_phno'";
    $checkDuplicateResult = mysqli_query($conn, $checkDuplicateQuery);

    if (mysqli_num_rows($checkDuplicateResult) > 0) {
        $existingData = mysqli_fetch_assoc($checkDuplicateResult);
        if ($existingData['owner_username'] == $owner_username) {
            echo "<script>
            alert('Username already exists. Please choose a different one.');
            window.history.back();
            </script>";
        }  
        
        if ($existingData['owner_phno'] == $owner_phno) {
            echo "<script>
            alert('Phone Number already exists. Please enter a different one.');
            window.history.back();
            </script>";
        }
    } else {
        // Insert data into the 'owners' table
        $insertOwnerQuery = "INSERT INTO owners (owner_id, owner_photo, owner_fname, owner_lname, owner_phno, owner_email, owner_username, owner_password)
                             VALUES ('$owner_id', '../images/owners/default_owner.png','$owner_fname', '$owner_lname', '$owner_phno', '$owner_email', '$owner_username', '$owner_password')";

        $insertResult = mysqli_query($conn, $insertOwnerQuery);

        if ($insertResult) {
            echo "<script>
            alert('Registration Successful!');
            setTimeout(function(){
                window.location.href = 'register.html';
            }, 1000); 
            </script>";
        } else {
            echo "<script>
            alert('Registration Failed.');
            setTimeout(function(){
                window.location.href = 'register.html';
            }, 1000);
            </script>";
        }
    }

    // Close the database connection
    mysqli_close($conn);
    exit();
} 
?>
