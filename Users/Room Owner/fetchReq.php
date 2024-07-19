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
        <div class="container">
            <div class="row">
                <?php
                include("../connection.php");
                $owner_id = $_SESSION['user_id'];
                $room_id = $_GET['room_id'];
                // Check if $owner_id is set and not empty
                if (isset($owner_id) && !empty($owner_id)) {
                    // Use $owner_id in your SQL query
                    $columns = "r.req_date ,r.req_id, r.stud_id, r.owner_id, r.room_id, r.req_date, s.stud_photo, s.stud_fname, s.stud_lname, s.stud_email, s.stud_phno";
                    $tables = "request_call r INNER JOIN students s ON r.stud_id = s.stud_id";

                    $condition = "WHERE r.owner_id = '$owner_id' AND r.room_id = '$room_id' AND req_status != 'accepted'";

                    $query = "SELECT $columns FROM $tables $condition";
                    $result = mysqli_query($conn, $query);


                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            // Access data using $row['column_name']
                            $req_date = $row['req_date'];
                            $req_id = $row['req_id'];
                            $stud_id = $row['stud_id'];
                            $room_id = $row['room_id'];
                            $stud_photo = $row['stud_photo'];
                            $stud_fname = $row['stud_fname'];
                            $stud_lname = $row['stud_lname'];
                            $stud_email = $row['stud_email'];
                            $stud_phone = $row['stud_phno'];
                            ?>

                            <div class="col-md-4">
                                <div class="card" style="border-radius: 19px; margin: 0; margin-top: 13px; margin-bottom: 12px;">
                                    <div class="card-body p-4" style="box-shadow: 0px 0px;">
                                        <?php
                                        $originalDate = $req_date;
                                        $dateTime = new DateTime($originalDate);
                                        $formattedDate = $dateTime->format('d-m-Y');
                                        ?>
                                        <div style="height: 36px; margin: 3px;">
                                            <p class="d-inline-flex float-end">
                                                Date :
                                                <?php echo $formattedDate; ?>
                                            </p>
                                        </div>
                                        <div class="d-flex" style="margin-top: 10px;">
                                            <img class="rounded-circle flex-shrink-0 me-3 fit-cover" width="47" height="44"
                                                src="<?php echo $stud_photo; ?>" style="margin-left: 3px;">
                                            <div>
                                                <p class="fw-bold mb-0" style="margin-top: 11px;">
                                                    <?php echo $stud_fname . " " . $stud_lname; ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div style="height: 31px; margin: 0; margin-left: 0; margin-top: 14px;">
                                            <p class="d-inline-flex float-start"
                                                style="margin: 0; margin-left: 0; margin-top: 0; margin-right: 3px; font-weight: bold;">
                                                Student Name :&nbsp;</p>
                                            <p class="d-inline-flex float-start" style="margin-top: 0; margin-left: 0;">
                                                <?php echo $stud_fname . " " . $stud_lname; ?>
                                            </p>
                                        </div>
                                        <div style="height: 31px; margin: 0; margin-left: 0; margin-top: 14px;">
                                            <p class="d-inline-flex float-start"
                                                style="margin: 0; margin-left: 0; margin-top: 0; margin-right: 3px; font-weight: bold;">
                                                Email :&nbsp;</p>
                                            <p class="d-inline-flex float-start" style="margin-top: 0; margin-left: 0;">
                                                <?php echo $stud_email; ?>
                                            </p>
                                        </div>
                                        <div style="height: 31px; margin: 0; margin-left: 0; margin-top: 14px;">
                                            <p class="d-inline-flex float-start"
                                                style="margin: 0; margin-left: 0; margin-top: 0; margin-right: 3px; font-weight: bold;">
                                                Phone :&nbsp;</p>
                                            <p class="d-inline-flex float-start" style="margin-top: 0; margin-left: 0;">
                                                <?php echo $stud_phone; ?>
                                            </p>
                                        </div>
                                        <!-- <div style="height: 31px; margin: 0; margin-left: 0; margin-top: 14px;"> -->
                                            <!-- <p class="d-inline-flex float-start"
                                                style="margin: 0; margin-left: 0; margin-top: 0; margin-right: 3px; font-weight: bold;">
                                                Room :&nbsp;</p>
                                            <p class="d-inline-flex float-start" style="margin-top: 0; margin-left: 0;">
                                                <a href="room.php?room_id=<?php echo $room_id; ?>" data-bs-toggle='modal'
                                                    data-bs-target='#roomModal_<?php echo $row['stud_id']; ?>'
                                                    style="text-decoration: underline;">See Room</a>
                                            </p> -->
                                        <!-- </div> -->

                                        <!-- See Room Modal -->
                                        <!-- <div class='modal fade modal-xl' id='roomModal_<?php echo $row['stud_id']; ?>' tabindex='-1'
                                            aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                            <div class='modal-dialog' style='width: 100% !important;'>
                                                <div class='modal-content' style='background-color:white;'>
                                                    <div class='modal-header'>
                                                        <h1 class='modal-title fs-5' id='exampleModalLabel'>Room Details are : </h1>
                                                        <button type='button' class='btn-close' data-bs-dismiss='modal'
                                                            aria-label='Close'></button>
                                                    </div>
                                                    <div class='modal-body' id='roomModalContent_<?php echo $row['stud_id']; ?>'>
                                                        <iframe src="room.php?room_id=<?php echo $room_id; ?>" frameborder="0"
                                                            style="width: 100%; height: 70vh;">
                                                        </iframe>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->

                                        <!-- Buttons  -->
                                        <div style="display:inline-block;">
                                            <button style="margin-top:10px" class='btn btn-primary btn-sm' data-bs-toggle='modal' 
                                                data-bs-target='#profileModal_<?php echo $row['stud_id']; ?>'>Profile &nbsp;<i
                                                    class='fa-solid fa-eye'></i>
                                            </button>
                                            <a style="margin-top:10px" class='btn btn-warning btn-sm' data-bs-toggle='modal'
                                                data-bs-target='#rateModal_<?php echo $row['stud_id']; ?>'
                                                href="studRating.php?stud_id=<?php echo $row['stud_id']; ?>" target="_blank">Ratings
                                                &nbsp;<i class='fa-solid fa-star'></i>
                                            </a>
                                            <div style="margin-top: 10px; display:flex;">
                                                <form method="POST" action="deleteReq.php">
                                                    <input type="hidden" name="req_id" value="<?php echo $req_id; ?>">
                                                    <button type="submit" name="deleteReq" class="btn btn-danger btn-sm" style="margin:2px;">
                                                        Delete &nbsp;<i class='fa-solid fa-trash'></i>
                                                    </button>
                                                </form>
                                                <form method="POST" action="deleteReq.php">
                                                    <input type="hidden" name="req_id" value="<?php echo $req_id; ?>">
                                                    <button type="submit" name="acceptReq" class="btn btn-success btn-sm" style="margin:2px;">
                                                        Accept &nbsp;<i class='fa-solid fa-check'></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>

                                        <!-- Student Profile Modal -->
                                        <div class='modal fade' id='profileModal_<?php echo $row['stud_id']; ?>' tabindex='-1'
                                            aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                            <div class='modal-dialog'>
                                                <div class='modal-content' style='background-color:white;'>
                                                    <div class='modal-header'>
                                                        <h1 class='modal-title fs-5' id='exampleModalLabel'>Student Profile Details
                                                        </h1>
                                                        <button type='button' class='btn-close' data-bs-dismiss='modal'
                                                            aria-label='Close'></button>
                                                    </div>
                                                    <div class='modal-body'>
                                                        <div class="table-responsive table mt-2" id="dataTable-1" role="grid"
                                                            aria-describedby="dataTable_info">
                                                            <table class="table my-0" id="dataTable">
                                                                <tbody>
                                                                    <?php
                                                                    include("../connection.php");
                                                                    $studId = $row['stud_id'];
                                                                    $sql = "SELECT * FROM students WHERE stud_id = '$studId';";
                                                                    $result2 = $conn->query($sql);
                                                                    if (!$result) {
                                                                        die("Invalid Query");
                                                                    }
                                                                    while ($innerrow = $result2->fetch_assoc()) {
                                                                        echo "
                                                                                    <tr>
                                                                                        <td> <img src='$innerrow[stud_photo]' style='border-radius: 42px;width: 60px;height: 60px;'> 
                                                                                        &nbsp; &nbsp; $innerrow[stud_fname] $innerrow[stud_lname]</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Gender : $innerrow[stud_gender]</td>
                                                                                    </tr>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Contact No. : $innerrow[stud_phno]</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Mail : $innerrow[stud_email]</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                        <center><b> Educational Background </b></center>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Name : $innerrow[stud_edu_bg]</td>
                                                                                    <tr>
                                                                                    <tr>
                                                                                        <td>Contact No. : $innerrow[stud_college_name]</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                        <center><b> Gaurdian Details </b></center>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Name : $innerrow[stud_gd_name]</td>
                                                                                    </tr>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Contact No. : $innerrow[stud_gd_phno]</td>
                                                                                    </tr>
                                                                                    ";

                                                                    }
                                                                    mysqli_free_result($result2);
                                                                    ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- See Rating Modal -->
                                        <div class='modal fade modal-xl' id='rateModal_<?php echo $row['stud_id']; ?>' tabindex='-1'
                                            aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                            <div class='modal-dialog' style='width: 100% !important;'>
                                                <div class='modal-content' style='background-color:white;'>
                                                    <div class='modal-header'>
                                                        <p class='modal-title fs-5' id='exampleModalLabel'>Following are the
                                                            Ratings and Reviews made by the Room Owners for this Student</p>
                                                        <button type='button' class='btn-close' data-bs-dismiss='modal'
                                                            aria-label='Close'></button>
                                                    </div>
                                                    <div class='modal-body' id='roomModalContent_<?php echo $row['stud_id']; ?>'>
                                                        <iframe src="studRating.php?stud_id=<?php echo $row['stud_id']; ?>"
                                                            frameborder="0" style="width: 100%; height: 70vh;">
                                                        </iframe>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        // Free result set
                        mysqli_free_result($result);
                    } else {
                        // Handle the query error
                        echo "Error: " . mysqli_error($conn);
                    }

                } else {
                    // Handle the case where $owner_id is not set or empty
                    echo "Error: Owner ID not available.";
                }
                ?>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.min.js?h=bdf36300aae20ed8ebca7e88738d5267"></script>
</body>

</html>