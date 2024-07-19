<!DOCTYPE html>
<html lang="en">

<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // user is not logged in, redirect to login page or show an access denied message
    echo "
    <script>
        alert('Log In First to Access this Page');
        setTimeout(function() {
            window.location.href = '../../login.html';
        }, 1000);
    </script>";
    exit();
}
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - Brand</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css?h=cb606d99bb2418df19b6bc818b41e412">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <script src="https://kit.fontawesome.com/9cb56d4a06.js" crossorigin="anonymous"></script>
</head>

<body id="page-top">
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="table-responsive table mt-2" id="dataTable-1" role="grid"
                                aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Owner</th>
                                            <th>Date</th>
                                            <th>Rating</th>
                                            <th>Review</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include("../connection.php");

                                        // Check if stud_id is present in the URL
                                            $stud_id = $_GET['stud_id'];
                                        
                                            // Use stud_id in your query to fetch data from student_reviews table
                                            $sql = "SELECT * FROM student_reviews WHERE stud_id = '$stud_id';";
                                            $result = $conn->query($sql);

                                        $hasData = false;
                                        while ($row = $result->fetch_assoc()) {
                                            $hasData = true;
                                            $owner_id = $row['owner_id'];
                                            $ownerQuery = "SELECT owner_photo, owner_fname, owner_lname FROM owners WHERE owner_id = '$owner_id'";
                                            $ownerResult = $conn->query($ownerQuery);

                                            if ($ownerResult) {
                                                $ownerData = $ownerResult->fetch_assoc();
                                            
                                                // Check if the owner data exists before using it
                                                if ($ownerData) {
                                                    $ownerName = $ownerData['owner_fname'] . ' ' . $ownerData['owner_lname'];
                                                } else {
                                                    $ownerName = 'Unknown Owner';
                                                }
                                            } else {
                                                // Handle the case where the query for owner data fails
                                                $ownerName = 'Error fetching owner data';
                                            }                         
                                            
                                            echo "
                                                <tr>
                                                    <td><img src='$ownerData[owner_photo]' width='60px' height='60px' style='border-radius:40px;''> &nbsp; $ownerName</td>
                                                    <td>$row[str_date]</td>
                                                    <td>$row[str_rating]</td>
                                                    <td>$row[str_review]</td>
                                                </tr>
                                                ";
                                        }

                                        if (!$hasData) {
                                            echo "
                                                    <tr>
                                                        <td colspan='5'> <b> No Data Found </b> </td>
                                                    </tr>
                                                ";
                                        }

                                        ?>
                                    </tbody>


                                    <tfoot>
                                        <tr></tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.min.js?h=bdf36300aae20ed8ebca7e88738d5267"></script>
</body>

</html>