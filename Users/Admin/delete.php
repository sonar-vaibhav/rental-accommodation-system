<?php
include '../connection.php';

$tableType = $_GET['account_type'];
$userId = $_GET['id'];

if ($tableType === 'students') {
    $deleteQuery = "DELETE FROM students WHERE stud_id = '$userId'";
} elseif ($tableType === 'owners') {
    $deleteQuery = "DELETE FROM owners WHERE owner_id = '$userId'";
}

if (isset($deleteQuery)) {
    mysqli_query($conn, $deleteQuery);
    echo "
        <script>
            alert('User Deleted Sucessfully');
            window.location.href = 'user_mgmt.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('User is not Deleted.');
            window.location.href = 'user_mgmt.php';
        </script>
    ";
}


exit();

?>