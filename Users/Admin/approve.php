<?php
include '../connection.php';

// Check if ID and account type are present in the URL
if (isset($_GET['id']) && isset($_GET['account_type'])) {
    $userId = $_GET['id'];
    $selectedTable = $_GET['account_type'];

    // Determine the table and ID column based on the user type
    if ($selectedTable === 'students') {
        $originalTable = 'students';
        $approvalTable = 'user_stud';
        $idColumn = 'stud_id';
        $usernameColumn = 'stud_username';
        $passwordColumn = 'stud_password';
    } elseif ($selectedTable === 'owners') {
        $originalTable = 'owners';
        $approvalTable = 'user_owner';
        $idColumn = 'owner_id';
        $usernameColumn = 'owner_username';
        $passwordColumn = 'owner_password';
    } else {
        // Handle other user types if needed
        exit("Invalid user type");
    }

    // Fetch data from the original table
    $selectQuery = "SELECT * FROM $originalTable WHERE $idColumn = '$userId'";
    $result = mysqli_query($conn, $selectQuery);

    if ($result) {
        $userData = mysqli_fetch_assoc($result);

        // Insert data into the approval table
        $insertQuery = "INSERT INTO $approvalTable ($idColumn, $usernameColumn, $passwordColumn) 
                        VALUES ('{$userData[$idColumn]}', '{$userData[$usernameColumn]}', '{$userData[$passwordColumn]}')";

        $insertResult = mysqli_query($conn, $insertQuery);

        if ($insertResult) {
            echo "Approval successful!";
            echo "\n Wait while, Redirecting to back . . .  .";
            echo "<script>
            setTimeout(() => {
                window.history.back();
              }, 2000);
            </script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }

        // You may want to add additional handling or redirect the user after approval
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // Handle case where ID or account type is not present in the URL
    echo "Invalid request";
}

// Close the database connection
mysqli_close($conn);
?>
