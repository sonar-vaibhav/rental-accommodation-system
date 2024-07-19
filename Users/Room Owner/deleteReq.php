<?php
include '../connection.php';
if (isset($_POST['deleteReq'])) {
    // Get the request ID from the form data
    $req_id = $_POST['req_id'];

    // Prepare and execute the DELETE query
    $query = "DELETE FROM request_call WHERE req_id = '$req_id'";
    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if ($result) {
        echo "
                                <script>
                                alert('Record deleted successfully');
                                window.location.href = 'call back req.php';
                                </script>
                                ";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

if (isset($_POST['acceptReq'])) {
    // Get the request ID from the form data
    $req_id = $_POST['req_id'];
    // Prepare and execute the DELETE query
    $query = "UPDATE request_call SET req_status = 'accepted' WHERE req_id = '$req_id'";
    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if ($result) {
        echo "
                                <script>
                                alert('Request Accepted successfully');
                                window.location.href = window.location.href;
                                </script>
                                ";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

?>