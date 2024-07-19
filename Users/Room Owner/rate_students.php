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
    <title>Table - Brand</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css?h=cb606d99bb2418df19b6bc818b41e412">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <script src="https://kit.fontawesome.com/9cb56d4a06.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  <script src="https://kit.fontawesome.com/9cb56d4a06.js" crossorigin="anonymous"></script>

  <style>
    #allStud,
    #reqStud {
        display: none;
    }
  </style>
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
                            class="nav-link active" href="rate_students.php"><svg xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512" width="1em" height="1em"
                                fill="currentColor"><!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                                <path
                                    d="M45.63 79.75L52 81.25v58.5C45 143.9 40 151.3 40 160c0 8.375 4.625 15.38 11.12 19.75L35.5 242C33.75 248.9 37.63 256 43.13 256h41.75c5.5 0 9.375-7.125 7.625-13.1L76.88 179.8C83.38 175.4 88 168.4 88 160c0-8.75-5-16.12-12-20.25V87.13L128 99.63l.001 60.37c0 70.75 57.25 128 128 128s127.1-57.25 127.1-128L384 99.62l82.25-19.87c18.25-4.375 18.25-27 0-31.5l-190.4-46c-13-3-26.62-3-39.63 0l-190.6 46C27.5 52.63 27.5 75.38 45.63 79.75zM359.2 312.8l-103.2 103.2l-103.2-103.2c-69.93 22.3-120.8 87.2-120.8 164.5C32 496.5 47.53 512 66.67 512h378.7C464.5 512 480 496.5 480 477.3C480 400 429.1 335.1 359.2 312.8z">
                                </path>
                            </svg><span style="margin: -2px;margin-left: 6px;">Rate Students</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="call%20back%20req.php"><svg
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
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0"
                        id="sidebarToggle" type="button"></button></div>
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
                <h3 class="text-dark mb-4">Add Students as Tenant & Rate them</h3>
                <button onclick="showTable1()" class="btn btn-primary btn-sm" >Add Tenants</button>
                <button onclick="showTable2()" class="btn btn-primary btn-sm" >Your Tenants</button>
                
                <div id="allStud" class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Add Students as your Tenant&nbsp;</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table mt-2" id="dataTable-1" role="grid" aria-describedby="dataTable_info">
                              <table id="dataTable" style="text-align:center;">
                                <thead>
                                  <tr>
                                    <th>Photo</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Request to be a Tenant</th>
                                  </tr>
                                </thead>
                                <tbody id="searchResult">
                                    <?php
                                    include("../connection.php");
                                    // Outer Loop for Students
                                    $sql = "SELECT * FROM students";
                                    $result = $conn->query($sql);
                                                        
                                    if (!$result) {
                                        die("Invalid Query");
                                    }
                                    $hasData = false;
                                    while ($row = $result->fetch_assoc()) {
                                        $hasData = true;
                                        echo "
                                        <tr>
                                            <td><img src='$row[stud_photo]' alt='Room Owner Profile' width='80px' height='50px'></td>
                                            <td>$row[stud_fname]</td>
                                            <td>$row[stud_lname]</td>
                                            <td>$row[stud_email]</td>
                                            <td>
                                            <button class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#addTenantModal_$row[stud_id]'>
                                                Add <i class='fa-solid fa-add'></i>
                                            </button>
                                            </td>
                                        </tr>
                                        ";
                                        echo "
                                            <div class='modal fade' id='addTenantModal_$row[stud_id]' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                                <div class='modal-dialog'>
                                                    <div class='modal-content' style='background-color:white;'>
                                                        <div class='modal-header'>
                                                            <h1 class='modal-title fs-5' id='exampleModalLabel'>Select a Room and Add the Student as a Tenant</h1>
                                                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                        </div>
                                                        <div class='modal-body'>
                                                        <form method='POST' action='addTenant.php'>
                                                        <input name='stud_id' value='$row[stud_id]' hidden>";
                                                        // Fetch tenants for checkboxes
                                                       
                                                        // Assuming you have the user_id available
                                                        $user_id = $_SESSION['user_id'];
                                                        $sql3 = "SELECT room_id FROM rooms WHERE owner_id = '$user_id'";
                                                        $result3 = mysqli_query($conn, $sql3);
                    
                                                        echo '<p>Note : To see which room you want to add tenant go to <a href="call back req.php">Request Call Page</a></p>';
                                                        if ($result3) {
                                                            $i = 1;
                                                            while ($row = mysqli_fetch_assoc($result3)) {
                                                                $room_id = $row['room_id'];

                                                                echo '<div class="form-check" style="margin-right: 20px;">';
                                                                echo '<input class="form-check-input" type="radio" value="' . $room_id . '" name="selectedRoom">';
                                                                echo '<label class="form-check-label" for="amenityCheck' . $room_id . '">';
                                                                echo "<a>Room $i</a>";
                                                                $i++;
                                                                echo "</label>";
                                                                echo '</div>';
                                                            }
                                                        } else {
                                                            echo "Error: " . mysqli_error($conn);
                                                        }
                                                        echo "
                                                                <br>
                                                                <button type='submit' class='btn btn-primary btn-sm' name='addTenant'>Add Tenant</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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

                              </table>
                            </div>

                            <script>
                              $(document).ready(function () {
                                // Initialize DataTable
                                // $('#dataTable').DataTable();
                                $('#dataTable').DataTable({
                                  "pageLength": 10, // Set the number of rows per page to 2
                                  "ordering": true, // Enable sorting
                                  // Add other options as needed
                                });

                                // Search functionality
                                $('#ownerSearch').on('input', function () {
                                  var searchTerm = $(this).val();

                                  // Call the PHP script using AJAX
                                  $.ajax({
                                    type: 'POST',
                                    url: 'search_owners.php',
                                    data: { search: searchTerm },
                                    success: function (response) {
                                      $('#searchResult').html(response);

                                      // Refresh DataTable after updating the content
                                      $('#dataTable').DataTable();
                                    },
                                    error: function (error) {
                                      console.log(error);
                                    }
                                  });
                                });
                              });
                            </script>
                            
                        </div>
                </div>

                <div id="reqStud" class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Following students are your tenant Rate them</p>
                        </div>
                        <div class="card-body">
                            <!-- DataTable -->
                            <div class="table-responsive table mt-2" id="dataTable-1" role="grid" aria-describedby="dataTable_info">
                                <table id="dataTable2" style="text-align:center;">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Room</th>
                                            <th class="text-center">Still Tenant</th>
                                            <th class="text-center">Entered</th>
                                            <th class="text-center">Exited</th>
                                            <th class="text-center">Photo</th>
                                            <th class="text-center">First Name</th>
                                            <th class="text-center">Last Name</th>
                                            <th class="text-center">Avg Rating</th>
                                            <th class="text-center">Contact No.</th>
                                            <th class="text-center">See Details</th>
                                        </tr>
                                    </thead>
                                    <tbody id="searchResult">
                                            <?php
                                            include("../connection.php");
                                            $ownerId = $_SESSION['user_id'];
                                            $sql = "SELECT * FROM tenants WHERE owner_id = '$ownerId'";
                                            $result = $conn->query($sql);
                                           
                                            $hasData = false;
                                            while ($row = $result->fetch_assoc()) {
                                                echo '<tr><td><button class="btn" target="_blank" data-bs-toggle="modal"
                                                    data-bs-target="#roomModal_'.$row['room_id'].'"><u>See Room</u></button></td>
                                                    <td>'.$row['still_tenant'].'</td>
                                                    <td>'.$row['added_date'].'</td>
                                                    <td>
                                                    ';
                                                    echo ($row['removed_date'] === '0000-00-00') ? '' : $row['removed_date'];
                                                $modalID = "roomModal_".$row['room_id'];
                                                echo '</td>
                                                <div class="modal fade modal-xl" id="'.$modalID.'" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" style="width: 100% !important;">
                                                        <div class="modal-content" style="background-color: white;">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Room Details are:</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body" id="roomModalContent_'.$row['room_id'].'">
                                                                <iframe src="room.php?room_id='.$row['room_id'].'" frameborder="0"
                                                                    style="width: 100%; height: 70vh;"></iframe>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>';

                                                $studsql = "SELECT * FROM students WHERE stud_id = '$row[stud_id]'";
                                                $result2 = $conn->query($studsql);
                                                if (!$result2) {
                                                  die("Invalid Query");
                                                }
                                                while ($studrow = $result2->fetch_assoc()) {
                                                    $avgsql = "SELECT stud_id, AVG(str_rating) AS avg_rating FROM student_reviews WHERE stud_id = '$row[stud_id]'";
                                                    $avgresult = mysqli_query($conn, $avgsql);

                                                    if ($avgresult) {
                                                        $temprow = mysqli_fetch_assoc($avgresult);
                                                        $avg_rating = number_format($temprow['avg_rating'],1);
                                                    } else {
                                                        echo "Error: " . mysqli_error($conn);
                                                    }
                                                    $hasData = true;
                                                    echo "
                                                            <td><img src='$studrow[stud_photo]' alt='Room Owner Profile' style='height: 70px;width: 75px;border-radius: 40px;'></td>
                                                            <td>$studrow[stud_fname]</td>
                                                            <td>$studrow[stud_lname]</td>
                                                            <td>$avg_rating</td>
                                                            <td>$studrow[stud_phno]</td>";

                                                            echo '<td style="display:inline-grid;">';
                                                            echo '<button class="btn btn-primary btn-sm" target="_blank" data-bs-toggle="modal" data-bs-target="#studProfileModal_'.$row['stud_id'].'">See
                                                            <i class="fa-solid fa-eye"></i></button>';

                                                            // Display Student Modal and Profile Button
                                                                echo '<div class="modal fade" id="studProfileModal_'.$row['stud_id'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
                                                                echo '<div class="modal-dialog">';
                                                                echo '<div class="modal-content" style="background-color:white;">';
                                                                echo '<div class="modal-header">';
                                                                echo '<h1 class="modal-title fs-5" id="exampleModalLabel">Student Profile Details</h1>';
                                                                echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                                                                echo '</div>';
                                                                echo '<div class="modal-body">';
                                                                echo '<div class="table-responsive table mt-2" id="dataTable-1" role="grid" aria-describedby="dataTable_info">';
                                                                echo '<table class="table my-0" id="dataTable">';
                                                                echo '<tbody>';
                                                                echo '<tr>';
                                                                echo '<td><img src="'.$studrow['stud_photo'].'" style="border-radius: 42px;width: 60px;height: 60px;">&nbsp; &nbsp;'.$studrow['stud_fname'].' '.$studrow['stud_lname'].'</td>';
                                                                echo '</tr>';
                                                                echo '<tr>';
                                                                echo '<td>Gender : '.$studrow['stud_gender'].'</td>';
                                                                echo '</tr>';
                                                                echo '<tr>';
                                                                echo '<td>Phone No : '.$studrow['stud_phno'].'</td>';
                                                                echo '</tr>';
                                                                echo '<tr>';
                                                                echo '<td>Email : '.$studrow['stud_email'].'</td>';
                                                                echo '</tr>';
                                                                echo '<tr>';
                                                                echo '<td>Home Town : '.$studrow['stud_hometown'].'</td>';
                                                                echo '</tr>';
                                                                echo '<tr>';
                                                                echo '<td><b>Educational Details</b></td>';
                                                                echo '</tr>';
                                                                echo '<tr>';
                                                                echo '<td>College : '.$studrow['stud_college_name'].'</td>';
                                                                echo '</tr>';
                                                                echo '<tr>';
                                                                echo '<td>Education : '.$studrow['stud_edu_bg'].'</td>';
                                                                echo '</tr>';
                                                                echo '<tr>';
                                                                echo '<td><b>Guardian Details</b></td>';
                                                                echo '</tr>';
                                                                echo '<tr>';
                                                                echo '<td>Name : '.$studrow['stud_gd_name'].'</td>';
                                                                echo '</tr>';
                                                                echo '<tr>';
                                                                echo '<td>Phone No. : '.$studrow['stud_gd_phno'].'</td>';
                                                                echo '</tr>';

                                                                // Add other details as needed
                                                                echo '</tbody>';
                                                                echo '</table>';
                                                                echo '</div>';
                                                                echo '</div>';
                                                                echo '</div>';
                                                                echo '</div>';
                                                                echo '</div>';
                                                            
                                                            echo '
                                                            <button style="margin-top: 2px;"" class="btn btn-warning btn-sm" target="_blank" data-bs-toggle="modal" data-bs-target="#rateModal_'.$row['stud_id'].'">Rate
                                                            <i class="fa-solid fa-star"></i></button>
                                                            
                                                            ';
                                                            if ($row['removed_date'] === '0000-00-00') {
                                                                echo"<a class='btn btn-danger btn-sm' href='kickTenant.php?stud_id=$row[stud_id]' style='margin-top: 2px;'>
                                                                Kick
                                                                <i class='fa-solid fa-person-walking-arrow-right'></i>
                                                                </a>";
                                                            }
                                                            else{

                                                            }
                                                            echo "                                                        
                                                            <!-- <a class='btn btn-danger btn-sm' href='removeTenant.php?stud_id=$row[stud_id]' style='margin-top: 2px;'>
                                                            Remove
                                                            <i class='fa-solid fa-trash'></i>
                                                            </a>  -->                                                      
                                                            </td>
                                                            </tr>
                                                        ";

                                                        echo "
                                                        <div class='modal fade' id='rateModal_$row[stud_id]' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                                            <div class='modal-dialog'>
                                                                <div class='modal-content' style='background-color:white;'>
                                                                    <div class='modal-header'>
                                                                        <h1 class='modal-title fs-5' id='exampleModalLabel'>Modal title</h1>
                                                                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                                    </div>
                                                                    <div class='modal-body'>
                                                                    <form method='post' action='addReview.php'>
                                                                    <input type='hidden' name='stud_id' value='$studrow[stud_id]'>
                                                                    <label class='form-label'>Name: $studrow[stud_fname] $studrow[stud_lname]</label>

                                                                    <div class='mb-3'>
                                                                        <label class='form-label'>Rating :</label>
                                                                        <div class='form-check d-inline-flex'>
                                                                            <input class='form-check-input' type='radio' id='rating-1' name='rating' value='1' style='margin-left: -4px;margin-right: 0px;'>
                                                                            <label class='form-check-label' for='rating-1' style='margin-left: 11px;margin-right: 0px;'>1</label>
                                                                        </div>

                                                                        <div class='form-check d-inline-flex'>
                                                                            <input class='form-check-input' type='radio' id='rating-2' name='rating' value='2' style='margin-left: -4px;margin-right: 0px;'>
                                                                            <label class='form-check-label' for='rating-2' style='margin-left: 11px;margin-right: 0px;'>2</label>
                                                                        </div>

                                                                        <div class='form-check d-inline-flex'>
                                                                            <input class='form-check-input' type='radio' id='rating-3' name='rating' value='3' style='margin-left: -4px;margin-right: 0px;'>
                                                                            <label class='form-check-label' for='rating-3' style='margin-left: 11px;margin-right: 0px;'>3</label>
                                                                        </div>

                                                                        <div class='form-check d-inline-flex'>
                                                                            <input class='form-check-input' type='radio' id='rating-4' name='rating' value='4' style='margin-left: -4px;margin-right: 0px;'>
                                                                            <label class='form-check-label' for='rating-4' style='margin-left: 11px;margin-right: 0px;'>4</label>
                                                                        </div>

                                                                        <div class='form-check d-inline-flex'>
                                                                            <input class='form-check-input' type='radio' id='rating-5' name='rating' value='5' style='margin-left: -4px;margin-right: 0px;'>
                                                                            <label class='form-check-label' for='rating-5' style='margin-left: 11px;margin-right: 0px;'>5</label>
                                                                        </div>
                                                                    </div>

                                                                    <div class='mb-3'>
                                                                        <textarea class='form-control' id='message-1' name='message' rows='6' placeholder='Review'></textarea>
                                                                    </div>

                                                                    <div>
                                                                        <button class='btn btn-primary d-block w-100' type='submit' name='submit'>Submit Review</button>
                                                                    </div>
                                                                </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        ";
                                                }
                                                
                                            }
                                            ?>
                                    </tbody>
                                </table>
                            </div>

                            <script>
                              $(document).ready(function () {
                                // Initialize DataTable
                                // $('#dataTable').DataTable();
                                $('#dataTable2').DataTable({
                                  "pageLength": 10, // Set the number of rows per page to 2
                                  "ordering": true, // Enable sorting
                                  // Add other options as needed
                                });

                                // Search functionality
                                $('#ownerSearch').on('input', function () {
                                  var searchTerm = $(this).val();

                                  // Call the PHP script using AJAX
                                  $.ajax({
                                    type: 'POST',
                                    url: 'search_owners.php',
                                    data: { search: searchTerm },
                                    success: function (response) {
                                      $('#searchResult').html(response);

                                      // Refresh DataTable after updating the content
                                      $('#dataTable2').DataTable();
                                    },
                                    error: function (error) {
                                      console.log(error);
                                    }
                                  });
                                });
                              });
                            </script>
                           
                        </div>
                </div>

                <script>
                var allStud = document.getElementById('allStud');        
                var reqStud = document.getElementById('reqStud');
                
                function showTable1(){
                    allStud.style.display = "block";
                    reqStud.style.display = "none";
                }
                function showTable2(){
                    reqStud.style.display = "block";
                    allStud.style.display = "none";
                }
                </script>
            </div>

        </div>
        <a class="border rounded d-inline scroll-to-top" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.min.js?h=bdf36300aae20ed8ebca7e88738d5267"></script>
</body>

</html>