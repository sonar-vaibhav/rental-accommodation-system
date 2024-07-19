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
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
            <div class="container-fluid d-flex flex-column p-0"><a
                    class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-15"></div>
                    <div class="sidebar-brand-text mx-3"><span class="text-capitalize">EZRooms</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link" href="index.php"><i
                                class="fas fa-tachometer-alt"></i><span
                                style="margin: -2px;margin-left: 6px;">Dashboard</span></a></li>
                    <li class="nav-item"></li>
                    <li class="nav-item"><a class="nav-link" href="manage%20room.php"><svg
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 -32 576 576" width="1em" height="1em"
                                fill="currentColor"><!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                                <path
                                    d="M575.8 255.5C575.8 273.5 560.8 287.6 543.8 287.6H511.8L512.5 447.7C512.5 450.5 512.3 453.1 512 455.8V472C512 494.1 494.1 512 472 512H456C454.9 512 453.8 511.1 452.7 511.9C451.3 511.1 449.9 512 448.5 512H392C369.9 512 352 494.1 352 472V384C352 366.3 337.7 352 320 352H256C238.3 352 224 366.3 224 384V472C224 494.1 206.1 512 184 512H128.1C126.6 512 125.1 511.9 123.6 511.8C122.4 511.9 121.2 512 120 512H104C81.91 512 64 494.1 64 472V360C64 359.1 64.03 358.1 64.09 357.2V287.6H32.05C14.02 287.6 0 273.5 0 255.5C0 246.5 3.004 238.5 10.01 231.5L266.4 8.016C273.4 1.002 281.4 0 288.4 0C295.4 0 303.4 2.004 309.5 7.014L564.8 231.5C572.8 238.5 576.9 246.5 575.8 255.5L575.8 255.5z">
                                </path>
                            </svg><span style="margin: -2px;margin-left: 6px;">Manage Rooms</span></a><a
                            class="nav-link" href="rate_students.php"><svg xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512" width="1em" height="1em"
                                fill="currentColor"><!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                                <path
                                    d="M45.63 79.75L52 81.25v58.5C45 143.9 40 151.3 40 160c0 8.375 4.625 15.38 11.12 19.75L35.5 242C33.75 248.9 37.63 256 43.13 256h41.75c5.5 0 9.375-7.125 7.625-13.1L76.88 179.8C83.38 175.4 88 168.4 88 160c0-8.75-5-16.12-12-20.25V87.13L128 99.63l.001 60.37c0 70.75 57.25 128 128 128s127.1-57.25 127.1-128L384 99.62l82.25-19.87c18.25-4.375 18.25-27 0-31.5l-190.4-46c-13-3-26.62-3-39.63 0l-190.6 46C27.5 52.63 27.5 75.38 45.63 79.75zM359.2 312.8l-103.2 103.2l-103.2-103.2c-69.93 22.3-120.8 87.2-120.8 164.5C32 496.5 47.53 512 66.67 512h378.7C464.5 512 480 496.5 480 477.3C480 400 429.1 335.1 359.2 312.8z">
                                </path>
                            </svg><span style="margin: -2px;margin-left: 6px;">Rate Students</span></a></li>
                    <li class="nav-item"><a class="nav-link active" href="call%20back%20req.php"><svg
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="1em" height="1em"
                                fill="currentColor"><!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                                <path
                                    d="M511.2 387l-23.25 100.8c-3.266 14.25-15.79 24.22-30.46 24.22C205.2 512 0 306.8 0 54.5c0-14.66 9.969-27.2 24.22-30.45l100.8-23.25C139.7-2.602 154.7 5.018 160.8 18.92l46.52 108.5c5.438 12.78 1.77 27.67-8.98 36.45L144.5 207.1c33.98 69.22 90.26 125.5 159.5 159.5l44.08-53.8c8.688-10.78 23.69-14.51 36.47-8.975l108.5 46.51C506.1 357.2 514.6 372.4 511.2 387z">
                                </path>
                            </svg><span style="margin: -2px;margin-left: 6px;">Call Back Requests</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="message.php"><svg xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 -64 640 640" width="1em" height="1em"
                                fill="currentColor"><!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                                <path
                                    d="M592 288H576V212.7c0-41.84-30.03-80.04-71.66-84.27C456.5 123.6 416 161.1 416 208V288h-16C373.6 288 352 309.6 352 336v128c0 26.4 21.6 48 48 48h192c26.4 0 48-21.6 48-48v-128C640 309.6 618.4 288 592 288zM496 432c-17.62 0-32-14.38-32-32s14.38-32 32-32s32 14.38 32 32S513.6 432 496 432zM528 288h-64V208c0-17.62 14.38-32 32-32s32 14.38 32 32V288zM224 256c70.7 0 128-57.31 128-128S294.7 0 224 0C153.3 0 96 57.31 96 128S153.3 256 224 256zM320 336c0-8.672 1.738-16.87 4.303-24.7C308.6 306.6 291.9 304 274.7 304H173.3C77.61 304 0 381.7 0 477.4C0 496.5 15.52 512 34.66 512h301.7C326.3 498.6 320 482.1 320 464V336z">
                                </path>
                            </svg><span style="margin: -2px;margin-left: 6px;">Admin Message</span></a><a
                            class="nav-link" href="profile.php"><i class="fas fa-user"></i><span
                                style="margin: -2px;margin-left: 6px;">Profile</span></a>
                                <a
                            class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i><span
                                style="margin: -2px;margin-left: 6px;">Logout</span></a>
                            </li>
                </ul>
                <div class="text-center d-none d-md-inline">
                    <button class="btn rounded-circle border-0" id="sidebarToggle" type="button"> </button>
                </div>
            </div>
        </nav>

        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
            <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3"
                            id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>

                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <?php
                            // Assuming $_SESSION['stud_id'] is set after a successful login
                            $owner_id = $_SESSION['user_id'];
                            include("../connection.php");
                            // Fetch student details using stud_id
                            $sql = "SELECT owner_fname, owner_lname, owner_photo FROM owners WHERE owner_id = '$owner_id'";
                            $result = mysqli_query($conn, $sql);

                            if ($result) {
                                if ($result->num_rows == 1) {
                                    $owner = mysqli_fetch_assoc($result);
                                    $owner_username = $owner['owner_fname'] . " " . $owner['owner_lname'];
                                    $owner_photo = $owner['owner_photo'];
                                } else {
                                    // Handle the case when the student is not found
                                    $owner_username = 'N/A';
                                    $owner_photo = 'https://shorturl.at/ptQS8'; // Provide a default photo or handle it based on your requirements
                                }
                                mysqli_free_result($result);
                            } else {
                                // Handle the case when there's an error in the query
                                $owner_username = 'N/A';
                                $owner_photo = 'https://shorturl.at/ptQS8';
                            }
                            ?>

                            <!-- Profile Logo -->
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow">
                                    <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown"
                                        href="#">
                                        <span class="d-none d-lg-inline me-2 text-gray-600 small">
                                            <?php echo $owner_username; ?>
                                        </span>
                                        <img class="border rounded-circle img-profile"
                                            src="<?php echo $owner_photo; ?>" style="height:50px; width:50px;">
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
            </nav>

                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">Call Back Request</h3>
                    </div>
                </div>

                <div class="container">
                    <?php
                    include '../connection.php';
                    $today = date('Y-m-d');
                    $ownerid = $_SESSION['user_id'];
                    // Today's requests
                    $queryToday = "SELECT COUNT(*) as today_count FROM request_call WHERE owner_id = '$ownerid' AND req_date = '$today'";
                    $resultToday = mysqli_query($conn, $queryToday);
                    $rowToday = mysqli_fetch_assoc($resultToday);
                    $todayCount = $rowToday['today_count'];

                    // This month's requests
                    $thisMonth = date('Y-m');
                    $queryThisMonth = "SELECT COUNT(*) as month_count FROM request_call WHERE owner_id = '$ownerid' AND DATE_FORMAT(req_date, '%Y-%m') = '$thisMonth'";
                    $resultThisMonth = mysqli_query($conn, $queryThisMonth);
                    $rowThisMonth = mysqli_fetch_assoc($resultThisMonth);
                    $thisMonthCount = $rowThisMonth['month_count'];

                    // Total requests
                    $queryTotal = "SELECT COUNT(*) as total_count FROM request_call WHERE owner_id = '$ownerid'";
                    $resultTotal = mysqli_query($conn, $queryTotal);
                    $rowTotal = mysqli_fetch_assoc($resultTotal);
                    $totalCount = $rowTotal['total_count'];
                    ?>

                    <!-- Stats -->
                    <div class="row">
                        <div class="col-md-4" style="width: 186.656px; margin: 5px;">
                            <div class="card shadow border-start-primary py-2"
                                style="width: 173.5px; height: 81.7969px;">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-primary fw-bold text-xs mb-1">
                                                <span>Today</span>
                                            </div>
                                            <div class="text-dark fw-bold h5 mb-0"><span>
                                                    <?php echo $todayCount; ?>
                                                </span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4" style="width: 186.656px; margin: 5px;">
                            <div class="card shadow border-start-success py-2"
                                style="width: 173.5px; height: 81.7969px;">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>This
                                                    month</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span>
                                                    <?php echo $thisMonthCount; ?>
                                                </span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4" style="width: 186.656px; margin: 5px;">
                            <div class="card shadow border-start-warning py-2"
                                style="width: 173.5px; height: 81.7969px;">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-warning fw-bold text-xs mb-1"><span>Total
                                                    Requests</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span>
                                                    <?php echo $totalCount; ?>
                                                </span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container table-responsive">
                    <table class="table" style="text-align: center;">
                        <thead>
                            <tr>
                                <th scope="col">Room</th>
                                <th scope="col">Requests Today</th>
                                <th scope="col">Requests This Month</th>
                                <th scope="col">Total Requests</th>
                                <th scope="col">Total Views</th>
                                <th scope="col">See Requests</th>
                            </tr>
                        </thead>
                        <tbody>
                                <?php
                                // Assuming you have the user_id available
                                $user_id = $_SESSION['user_id'];
                                $sql = "SELECT * FROM rooms WHERE owner_id = '$user_id'";
                                $result = mysqli_query($conn, $sql);
                                if ($result) {
                                    $i = 1;
                                
                                    // Move modal structure outside the loop
                                    echo '<div id="modals-container">';
                                
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $room_id = $row['room_id'];
                                        $room_views = $row['room_views'];
                                        echo "<tr>";
                                        echo '<td><button class="btn" target="_blank" data-bs-toggle="modal"
                                            data-bs-target="#roomModal_'.$room_id.'"><u>Room '.$i.'</u></button></td>';
                                        $modalID = "roomModal_".$room_id;
                                        echo '<div class="modal fade modal-xl" id="'.$modalID.'" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" style="width: 100% !important;">
                                                <div class="modal-content" style="background-color: white;">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Room Details are:</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body" id="roomModalContent_'.$room_id.'">
                                                        <iframe src="room.php?room_id='.$room_id.'" frameborder="0"
                                                            style="width: 100%; height: 70vh;"></iframe>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
                                        $i++;
                                    
                                        // Different variable names for each set of data
                                        $todayCount = 0;
                                        $thisMonthCount = 0;
                                        $totalCount = 0;
                                    
                                        $todayDate = date('Y-m-d');
                                        // Today's requests
                                        $queryToday = "SELECT COUNT(*) as today_count FROM request_call WHERE room_id = '$room_id' AND req_date = '$todayDate'";
                                        $resultToday = mysqli_query($conn, $queryToday);
                                        $rowToday = mysqli_fetch_assoc($resultToday);
                                        $todayCount = $rowToday['today_count'];
                                    
                                        $thisMonth = date('Y-m');
                                        // This month's requests
                                        $queryThisMonth = "SELECT COUNT(*) as month_count FROM request_call WHERE room_id = '$room_id' AND DATE_FORMAT(req_date, '%Y-%m') = '$thisMonth'";
                                        $resultThisMonth = mysqli_query($conn, $queryThisMonth);
                                        $rowThisMonth = mysqli_fetch_assoc($resultThisMonth);
                                        $thisMonthCount = $rowThisMonth['month_count'];
                                    
                                        // Total requests
                                        $queryTotal = "SELECT COUNT(*) as total_count FROM request_call WHERE room_id = '$room_id'";
                                        $resultTotal = mysqli_query($conn, $queryTotal);
                                        $rowTotal = mysqli_fetch_assoc($resultTotal);
                                        $totalCount = $rowTotal['total_count'];
                                    
                                        echo "<td>$todayCount</td>";
                                        echo "<td>$thisMonthCount</td>";
                                        echo "<td>$totalCount</td>";
                                        echo "<td>$room_views</td>";
                                        echo '
                                        <td> 
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#seereqModal_'. $room_id .'">
                                            See <i class="fa-solid fa-eye"></i>
                                        </button>
                                        </td>';
                                        echo "</tr>";
                                        echo '<div class="modal fade modal-xl" id="seereqModal_' . $room_id . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" style="width: 100% !important;">
                                                    <div class="modal-content" style="background-color:white;">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Call back Requests for the selected Room are : </h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body" id="roomModalContent_' . $room_id . '">
                                                            <iframe src="fetchReq.php?room_id=' . $room_id . '" frameborder="0" style="width: 100%; height: 70vh;"></iframe>
                                                        </div>
                                                    </div>
                                                </div>
                                              </div>';
                                    }
                                } else {
                                    echo "Error: " . mysqli_error($conn);
                                }
                                ?>
                        </tbody>
                    </table>  
                </div>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.min.js?h=bdf36300aae20ed8ebca7e88738d5267"></script>
</body>

</html>